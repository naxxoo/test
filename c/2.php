<?php
$start = 3;
$end = 5;
$startTime = 6;
$endTime = 12;
//6-12,6-8
if($start>$endTime ||$end<$startTime){
    echo '1';
}else{
    echo '0';
}