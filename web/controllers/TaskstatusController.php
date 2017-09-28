<?php

namespace app\controllers;

use Yii;
use app\models\Taskstatus;
use app\models\Tasks;
use app\models\TaskstatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskstatusController implements the CRUD actions for Taskstatus model.
 */
class TaskstatusController extends Controller {

    public function beforeAction($action) {

        $currentaction = $action->id;

        $novalidactions = ['commit'];

        if (in_array($currentaction, $novalidactions)) {

            $action->controller->enableCsrfValidation = false;
        }
        parent::beforeAction($action);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Taskstatus models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TaskstatusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Taskstatus model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Taskstatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Taskstatus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Taskstatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCommit() {
        $rtn = array(
            'ret' => -1,
            'message' => 'error entry',
            'retcode' => '',
        );
        if (Yii::$app->request->getMethod() == "GET") {
            $data = Yii::$app->request->get();
        } else {
            $data = Yii::$app->request->post();
        }
        $datatype = 'json';
        if (isset($data) & $data) {
            $cmd = isset($data['cmd']) ? $data['cmd'] : 'version';
            $datatype = isset($data['type']) ? $data['type'] : 'json';
            $method = 'Cmd' . ucfirst($cmd);
            if (method_exists($this, $method)) {
                $rtn = call_user_func_array(array($this, $method), array($data));
            } else {
                $rtn = array(
                    'ret' => -2,
                    'message' => 'command not exist',
                );
            }

            $retcode = (isset($data['retcode']) && $data['retcode'] ) ? $data['retcode'] : '';
            $rtn['retcode'] = $retcode;
        }
        if ($datatype == 'php') {
            print_r($rtn);
        } else {
            echo json_encode($rtn);
        }
        exit(0);
    }

    /**
     * Updates an existing Taskstatus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Taskstatus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Taskstatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Taskstatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Taskstatus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function _common_help() {
        $rtn = array(
            'help' => '可选，当设置为1时，不作任何操作，仅返回本命令使用方法的help',
            'type' => '可选，可以设置成json, php之中的一个，用于指定返回的数据格式，缺省是json',
            'retcode' => '可选，用户设置的字符串，会原样返回',
        );
        return $rtn;
    }

    protected function cmdEcho($param) {
        if (isset($param['help']) && $param['help']) {
            $rtn = array(
                'ret' => 0, // 表明正常返回
                'cmd' => 'echo', // 本命令
                'description' => '原样返回发送者发送的参数', // 本命令的解释
                'detail' => '本命令不作任何操作原样返回发送者发送的参数',
                'auth' => null, // 无需任何权限
                'return' => '原样返回发送者发送的参数', // 返回值的说明
                'params' => $this->_common_help(), //本命令使用通用的参数
            );
        } else {
            $rtn = array(
                'ret' => 0, // 表明正常返回
                'data' => $param,
            );
        }
        return $rtn;
    }

    protected function cmdVersion($param) {
        if (isset($param['help']) && $param['help']) {
            $rtn = array(
                'ret' => 0, // 表明正常返回
                'cmd' => 'version', // 本命令
                'description' => 'ymanage服务器版本信息', // 本命令的解释
                'detail' => '返回ymanage服务器版本信息',
                'auth' => null, // 无需任何权限
                'return' => 'ymanage服务器版本信息', // 返回值的说明
                'params' => $this->_common_help(), //本命令使用通用的参数
            );
        } else {
            $rtn = array(
                'ret' => 0, // 表明正常返回
                'version' => '0.1',
            );
        }
        return $rtn;
    }

    protected function cmdCommit($param) {
        if (isset($param['help']) && $param['help']) {
            $rtn = array(
                'ret' => 0, // 表明正常返回
                'cmd' => 'commit', // 本命令
                'description' => '提交数据', // 本命令的解释
                'detail' => '向服务器提交数据',
                'auth' => null, // 无需任何权限
                'return' => '数据是否正确存储', // 返回值的说明
                'params' => array_merge($this->_common_help(), array(
                    'uuid' => '可选，此任务唯一ID，用于多次提交信息时辨认同一任务',
                    'hostname' => '主机名',
                    'username' => '用户名',
                    'taskid' => '任务id',
                    'command' => '命令',
                    'starttime' => '可选，任务开始时间',
                    'endtime' => '可选，任务结束时间',
                    'status' => '简短的结果标识，通常是OK或者NG表示成功与否',
                    'outputtext' => '执行结果的文本',
                        //'outputfile' => '结果文件如有',
                        )
                ),
            );
        } else {
            date_default_timezone_set ( 'PRC' );
            $tasks = Tasks::find()->where(['hostname' => $param['hostname'], 'command' => $param['command']]);
            if ($tasks->count()) {
                $thetask = $tasks->one();
                $thetask->hostname = $param['hostname'];
                $thetask->username = $param['username'];
                $param['taskid'] = $thetask->id;
                $thetask->lasttime = date('Y-m-d H:i:s');
                $thetask->save();
            }else{
                $thetask = new Tasks();
                $thetask->hostname = $param['hostname'];
                $thetask->username = $param['username'];
                $thetask->command = $param['command'];
                $thetask->name = basename(explode(' ', $param['command'])[0]);
                $thetask->lasttime = date('Y-m-d H:i:s');
                $thetask->save();
                $param['taskid'] = $thetask->id;
            }
            $model = new Taskstatus();
            try {
                $data = array('Taskstatus' => $param);
                if ($model->load($data) && $model->save()) {
                    $rtn['ret'] = 0;
                    $rtn['message'] = 'OK';
                } else {
                    $rtn['ret'] = -3;
                    $rtn['message'] = $model->getErrors();
                }
            } catch (Exception $e) {
                $rtn['ret'] = -2;
                $rtn['message'] = $e->message;
            }
        }
        return $rtn;
    }

}
