<?php
$password = "myPassword_!";
$messageClear = "Secret message";

// 32 byte binary blob
//$aes256Key = hash("SHA256", $password, true);
$aes256Key = '8D4F16E8F94796FC';
// for good entropy (for MCRYPT_RAND)
//srand((double) microtime() * 1000000);
// generate random iv
//$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND);
$iv = '0102030405060708';

$crypted = fnEncrypt($messageClear, $aes256Key);
//$crypted = 'ZDIzYjRhMDVmZTg0YzY0YTliY2IwNjFkYzVjODkzMGM';
$newClear = fnDecrypt($crypted, $aes256Key);
//$newClear = base64_encode($newClear);
echo
    "IV:        <code>".$iv."</code><br/>".
    "Encrypred: <code>".$crypted."</code><br/>".
    "Decrypred: <code>".$newClear."</code><br/>";

function fnEncrypt($sValue, $sSecretKey) {
    global $iv;
    return rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $sSecretKey, $sValue, MCRYPT_MODE_ECB, $iv)), "\0\3");
}

function fnDecrypt($sValue, $sSecretKey) {
    global $iv;
    return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $sSecretKey, base64_decode($sValue), MCRYPT_MODE_ECB, $iv), "\0\3");
}