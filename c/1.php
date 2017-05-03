<?php
date_default_timezone_set('Asia/Shanghai');

$applyTime = strtotime('2017-03-27');

echo 'apply = ',date('Y-m-d H:i:s',$applyTime);
echo '<br/>';
$jiezhi = date('Y-m-26');
$lastMonth = date("Y-m-26",strtotime("last month"));
echo 'this month 26th = ',$jiezhi,'<br/>';
echo 'last month 26th = ',$lastMonth,'<br/>';

if($applyTime < strtotime($jiezhi)){
    if($applyTime > strtotime($lastMonth) ){
        echo 'able';
    }else{
        echo 'disabled';
    }
}else{
    echo 'able';
}
