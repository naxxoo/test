<?php
$p = '/^\d{11}$/';
$str = '1881111222';
if(preg_match($p,$str)){
	echo '1';
}else{
	echo '0';	
}