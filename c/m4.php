<?php
print("-- Start --<br />");
include("AES.class.php");
$z = '8D4F16E8F94796FC';
$data = 'qwe123';
$mode = MCRYPT_MODE_ECB;
$iv = '0102030405060708';

$aes = new AES($z, $mode, $iv);
$starte = microtime(true);
$encrypted = $aes->encrypt($data);
$ende = microtime(true);
print "Execution time to encrypt: " . ($ende - $starte) . " seconds<br />";
print "Cipher-Text: " . $encrypted . "<br />";
print "Hex: " . bin2hex($encrypted) . "<br />";
print "Base 64: " . base64_encode($encrypted) . "<br /><br />";
$startd = microtime(true);$encrypted = 'ZDIzYjRhMDVmZTg0YzY0YTliY2IwNjFkYzVjODkzMGM';
$decrypted = $aes->decrypt($encrypted);
$endd = microtime(true);
print "Execution time to decrypt: " . ($endd - $startd) . " seconds<br />";
print "Decrypted-Text: " . stripslashes($decrypted);
print "<br />-- End --<br />";
