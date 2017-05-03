<?php
class MagicCrypt {
    private $iv = "0102030405060708";//密钥偏移量IV，可自定义

    private $encryptKey = "8D4F16E8F94796FC";//AESkey，可自定义

    private $mode = MCRYPT_MODE_ECB;
    //加密
    public function encrypt($encryptStr) {
        $localIV = $this->iv;
        $encryptKey = $this->encryptKey;
        $mode = $this->mode;

        //Open module
        $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', $mode, $localIV);

        //print "module = $module <br/>" ;

        mcrypt_generic_init($module, $encryptKey, $localIV);

        //Padding
        $block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, $mode);
        $pad = $block - (strlen($encryptStr) % $block); //Compute how many characters need to pad
        $encryptStr .= str_repeat(chr($pad), $pad); // After pad, the str length must be equal to block or its integer multiples

        //encrypt
        $encrypted = mcrypt_generic($module, $encryptStr);

        //Close
        mcrypt_generic_deinit($module);
        mcrypt_module_close($module);

        return rtrim(base64_encode($encrypted), "\0\3");

    }

    //解密
    public function decrypt($encryptStr) {
        $localIV = $this->iv;
        $encryptKey = $this->encryptKey;
        $mode = $this->mode;

        //Open module
        $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', $mode, $localIV);

        //print "module = $module <br/>" ;

        mcrypt_generic_init($module, $encryptKey, $localIV);

        $encryptedData = base64_decode($encryptStr);
        $encryptedData = mdecrypt_generic($module, $encryptedData);

        return rtrim($encryptedData, "\0\3");
    }
}
$encryptString = 'qwe123qqwe';
$encryptObj = new MagicCrypt();

$result = $encryptObj->encrypt($encryptString);//加密结果
//$result = 'ZDIzYjRhMDVmZTg0YzY0YTliY2IwNjFkYzVjODkzMGM';
$decryptString =  $encryptObj->decrypt($result);//解密结果
echo $result . "<br/>";
echo $decryptString . "<br/>";