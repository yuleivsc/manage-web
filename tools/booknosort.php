<?php

$csvfile = $argv[1];

$a = array_map('str_getcsv', file($csvfile));
//var_dump($a);
$i = 0;
$j = 0;
$list = array();
foreach ($a as $b) {
    if ($b[7]) {
        if ($b[6]) {
            if ($b[8] != (1 + $b[7] - $b[6])) {
                echo "ERROR: $b[8] $b[6]  $b[7] $b[0]  $b[1] \n";
                continue;
            }
            for ($i = (0 + $b[6]); $i <= (0 + $b[7]); $i++) {
                $t = $b;
                array_unshift($t, $i);
                if (isset($list[$i])) {
                    $b1 = $list[$i];
                    echo "ERROR: norepeat1 $i $b[0]:$b[1]  $b1[1]:$b1[2] \n";
                }
                $list[$i] = $t;
                //fputcsv(STDOUT, $t);
            }
        } else {
            echo "ERROR: noend !  $b[0]  $b[1]\n";
        }
    }elseif ($b[6]) {
        $t = $b;
        $i = $b[6];
        array_unshift($t, $i);
        if (isset($list[$i])) {
            $b1 = $list[$i];
            echo "ERROR: norepeat $i $b[0]:$b[1]  $b1[1]:$b1[2] \n";
        }
        $list[$b[6]] = $t;
        //fputcsv(STDOUT, $t);
    }
}

ksort($list);
//var_dump($list);
foreach ($list as $i => $l) {
    fputcsv(STDOUT, $l);
}
?>
