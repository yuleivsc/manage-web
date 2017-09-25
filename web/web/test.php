<?php
/*
 *  * $Id: index.php 385 2013-03-24 10:03:06Z yulei $
 *   */
session_start();

$DEFAULT_SERVER_URL = 'http://manage.yulei.org/index.php?r=taskstatus/commit';
session_start();
$CMD_LIST = array(
    'echo',
    'version',
    'commit',
);

function getCmdInfo($cmd) {
    global $DEFAULT_SERVER_URL;
    $url = $DEFAULT_SERVER_URL;
    $params = array(
        'help' => 1,
        'type' => 'json',
        'cmd' => $cmd,
    );
    $info = Http::api($url, $params, "GET");
    $info['auth_str'] = $info['auth'] ? $info['auth'] : '无';
    $info['method'] = "BOTH";
    $info['method_str'] = strcasecmp($info['method'], 'BOTH') == 0 ? 'GET或POST' : $info['method'];
    return $info;
}

function getAllCmd() {
    global $CMD_LIST;
    if (!$_REQUEST['refresh']) {
        if ($_SESSION['cmd_array']) {
            $ret = $_SESSION['cmd_array'];
            return $ret;
        }
    }
    $ret = array();
    foreach ($CMD_LIST as $cmd) {
        $info = getCmdInfo($cmd);
        $ret[] = $info;
    }
    $_SESSION['cmd_array'] = $ret;
    return $ret;
}

function outputError($r) {
    $ret = '服务器返回了一个错误信息：<ul>' . "\n";
    $ret .= '<li>返回错误值：' . $r['ret'] . '</li>' . "\n";
    $ret .= '<li>错误代码1：' . $r['code1'] . '</li>' . "\n";
    $ret .= '<li>错误代码2：' . $r['code2'] . '</li>' . "\n";
    $ret .= '<li>错误信息：' . $r['message'] . '</li>' . "\n";
    $ret .= '<li>错误中文信息：' . $r['zhmessage'] . '</li>' . "\n";
    $detail = preg_replace('/\n/', "<br />", $r['detail']);
    $ret .= '<li>错误详细信息：<br />' . $detail . '</li></ul>' . "\n";
    return $ret;
}

/**
 * HTTP请求类
 * @author xiaopengzhu <xp_zhu@qq.com>
 * @version 2.0 2012-04-20
 */
class Http {

    public static function api($url, $params = array(), $method = 'GET', $multi = false, $extheaders = array()) {
        $r = Http::request($url, $params, $method, $multi, $extheaders);
        $r = preg_replace('/[^\x20-\xff]*/', "", $r); //清除不可见字符
        $r = iconv("utf-8", "utf-8//ignore", $r); //UTF-8转码
        $ret = json_decode($r, true);
        return $ret;
    }

    /**
     * 发起一个HTTP/HTTPS的请求
     * @param $url 接口的URL 
     * @param $params 接口参数   array('content'=>'test', 'format'=>'json');
     * @param $method 请求类型    GET|POST
     * @param $multi 图片信息
     * @param $extheaders 扩展的包头信息
     * @return string
     */
    public static function request($url, $params = array(), $method = 'GET', $multi = false, $extheaders = array()) {
        if (!function_exists('curl_init'))
            exit('Need to open the curl extension');
        $method = strtoupper($method);
        $ci = curl_init();
        curl_setopt($ci, CURLOPT_USERAGENT, 'PHP-SDK OAuth2.0');
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ci, CURLOPT_TIMEOUT, 3);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ci, CURLOPT_HEADER, false);
        curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE);
        switch ($method) {
            case 'POST':
                curl_setopt($ci, CURLOPT_POST, TRUE);
                if (!empty($params)) {
                    if ($multi) {
                        foreach ($multi as $key => $file) {
                            $params[$key] = '@' . $file;
                        }
                        curl_setopt($ci, CURLOPT_POSTFIELDS, $params);
                        $headers[] = 'Expect: ';
                    } else {
                        curl_setopt($ci, CURLOPT_POSTFIELDS, http_build_query($params));
                    }
                }
                break;
            case 'DELETE':
            case 'GET':
                $method == 'DELETE' && curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if (!empty($params)) {
                    $url = $url . (strpos($url, '?') ? '&' : '?')
                            . (is_array($params) ? http_build_query($params) : $params);
                }
                break;
        }
        curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE);
        curl_setopt($ci, CURLOPT_URL, $url);
        if ($headers) {
            curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
        }

        $response = curl_exec($ci);
        if ( $reponse === FALSE ) {
            $reponst = 'ERROR' . curl_error($ci);
        }
        curl_close($ci);
        return $response;
    }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <h3>这是用来测试ymanage网络协议的工具网页</h3>
        <hr />
        <?php
        if (!$_REQUEST['cmd']) {  // 命令列表
            echo '<table border="1">';
            echo '<tr><td>命令</td><td>概要</td><td>权限</td><td>可用方法</td></tr>' . "\n";
            $cmdlist = getAllCmd();
            foreach ($cmdlist as $cmdinfo) {
                echo '<tr><td><a href="' . $_SERVER['REQUEST_URI'] . '?cmd=' . $cmdinfo['cmd'] . '"</a>' . $cmdinfo['cmd'] . '</td>';
                echo '<td>' . $cmdinfo['description'] . '</td>';
                echo '<td>' . $cmdinfo['auth_str'] . '</td>';
                echo '<td>' . $cmdinfo['method_str'] . '</td>';
                echo"</tr>\n";
            }
            echo '</table>' . "\n";
        } elseif (!$_REQUEST['http_exec']) { // 命令的帮助和测试输入界面
            $cmdinfo = getCmdInfo($_REQUEST['cmd']);
            if ($cmdinfo['ret'] != 0) {
                echo outputError($cmdinfo);
            } else {
                //var_dump($_SERVER);
                ?>
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>">返回主页</a>
                <h4><?php echo $cmdinfo['cmd']; ?></h4>
                <ul>
                    <li>命令描述：<?php echo $cmdinfo['description']; ?></li>
                    <li>详细说明：<font size="-1"><pre><?php echo htmlspecialchars($cmdinfo['detail']); ?></pre></font></li>
                                    <li>权限：<?php echo $cmdinfo['auth_str']; ?></li>
                                    <li>可用方法：<?php echo $cmdinfo['method_str']; ?></li>
                                    <li>返回值说明：<font size="-1"><pre><?php echo htmlspecialchars($cmdinfo['return']); ?></pre></font></li>
                                </ul>
                                <form method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="http_exec" value="<?php echo $cmdinfo['cmd']; ?>" />
                                    <input type="hidden" name="cmd" value="<?php echo $cmdinfo['cmd']; ?>" />
                    <?php
                    foreach ($cmdinfo['params'] as $param => $paramdes) {
                        echo $param;

                        echo ':<input type="text" name="' . $param . '" size="30" />';
                        echo '<font size=-1>(' . $paramdes . ')</font>';
                        echo "<br />\n";
                    }
                    if ($cmdinfo['fileparams']) {
                        foreach ($cmdinfo['fileparams'] as $param => $paramdes) {
                            echo $param;
                            echo ':<input type="file" name="' . $param . '" size="30" />';
                            echo '<font size=-1>(' . $paramdes . ')</font>';
                            echo "<br />\n";
                            echo '<input type="hidden" name="http_file_' . $param . '" value="1" />';
                            echo '<input type="hidden" name="XDEBUG_SESSION_START" value="dbgp" />';
                        }
                    }
                    ?>
                       使用方法：<select name="http_method" >
                        <?php
                        if (strcasecmp($cmdinfo['method'], 'BOTH') == 0 || strcasecmp($cmdinfo['method'], 'GET') == 0) {
                            ?>
                                                    <option value="GET">GET</option>
                            <?php
                        }
                        if (strcasecmp($cmdinfo['method'], 'BOTH') == 0 || strcasecmp($cmdinfo['method'], 'POST') == 0) {
                            ?>
                                                    <option value="POST" >POST </option>
                            <?php
                        }
                        ?>
                                    </select><br />
                                    使用服务器:<input type="text" name="http_server" value="<?php echo $DEFAULT_SERVER_URL; ?>"  size="50" /><br /><br />
                                    <input type="submit"  /><input type="reset"  />
                                </form>
                <?php
            }
        } else { // 执行命令
            $params = array();
            $multi = array();
            $cmd = $_REQUEST['http_exec'];
            $method = $_REQUEST['http_method'];
            $url = $_REQUEST['http_server'];
            foreach ($_REQUEST as $key => $value) {
                if ($key == 'http_exec' || $key == 'http_method' || $key == 'http_server') {
                    continue;
                }
                if (strpos($key, 'http_file_') !== false) {
                    $key1 = substr($key, 10);
                    if (!$_FILES[$key1]['tmp_name']) {
                        die('上传文件不存在：' . $name);
                    }
                    if (!is_uploaded_file($_FILES[$key1]['tmp_name'])) {
                        die('这不是个上传的文件');
                    }
                    $desttmpfile = '/tmp/' . $_FILES[$key1]['name'];
                    move_uploaded_file($_FILES[$key1]['tmp_name'], $desttmpfile);
                    $multi[$key1] = $desttmpfile;
                    continue;
                }
                if ($value !== null && strlen($value) != 0) {
                    $params[$key] = $value;
                }
            }
            $info = Http::request($url, $params, $method, $multi ? $multi : false);
            ?>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>">返回主页</a> | <a href="<?php echo $_SERVER['PHP_SELF'] . '?cmd=' . $cmd; ?>">继续测试</a>
                    <h4>执行命令：<?php echo $cmd; ?></h4>
                    <h4>URL:<?php echo $url; ?></h4>
                    使用<?php echo $method; ?>方法和以下参数：
                    <ul>
                <?php
                foreach ($params as $param => $value) {
                    if ($param == 'cmd') {
                        continue;
                    }
                    echo '<li>' . $param . ':"' . $value . '"</li>' . "\n";
                }
                ?>
                    </ul>
                    <hr />
            <?php
//            if ($info['ret'] != 0) {
//                echo outputError($info);
//            } elseif ($info) {
                $v = var_export($info, true);
                echo '得到如下结果：<br />';
                echo '<pre>' . $v . '</pre>';
//            } else {
//                echo '服务器没有返回任何信息';
//            }
        }
        ?>
    </body>
</html>
