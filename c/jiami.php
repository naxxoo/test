<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/1/12 0012
 * Time: 15:33
 */
class Security {
    public static function encrypt($input, $key) {
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
        $input = Security::pkcs5_pad($input, $size);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
        $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = bin2hex($data);
        return $data;
    }


    private static function pkcs5_pad ($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    private static function hex2bin($hexdata) {
        $bindata = '';
        $length = strlen($hexdata);
        for ($i=0; $i< $length; $i += 2)
        {
            $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
        }
        return $bindata;
    }
    public static function decrypt2($sStr, $sKey){
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');

        $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);

        mcrypt_generic_init($td, $sKey, $iv);
        $decrypted_text = mdecrypt_generic($td,  Security::hex2bin($sStr));
        //$decrypted_text = mdecrypt_generic($td, base64_decode($str));
        $rt = $decrypted_text;

        //print_r($rt);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
        $rt = Security::pkcs5_pad($rt, $size);

        $dec_s = strlen($rt);
        $padding = ord($rt[$dec_s-1]);
        $rt = substr($rt, 0, -$padding);

        return $rt ;
    }
}


$input  = "http://mp.weixin.qq.com/s/aGnM4k2N3QfxFbEb3C6lgg";
$key    = md5("key");
$str = Security::encrypt($input,$key);
echo $str;

$out = Security::decrypt2($str,$key);
echo "\r\n";
echo $out;