<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/2/27 0027
 * Time: 11:43
 */
function httpCurl(){
    $url = "http://localhost/view/message.php?func=posted";

    $post_data = array ("adder_name" => "bob",
        "adder_email" => "abc@163.com",
        "messageType" => "1",
        "adder_id" => "0",
        "content" => "wobushidao",
        "ipaddress" => "127.0.0.1",
        "answerType" => "1",
        "answerTime" => "1",
        "adder_tel" => "18657299193",
        "verifyCode" => "5xn5"

    );

    $ch = curl_init();
    $header = array(
        "content-type: application/json;charset=UTF-8; "
    );
    curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_HEADER, 0);//设定是否输出页面内容
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_TIMEOUT,10);//超时

    $res = curl_exec($ch);

    if(curl_errno($ch)>0){
        //var_dump(curl_errno($ch));
        //var_dump(curl_error($ch));
        return array();
    }

    curl_close($ch);

    //$data = json_decode($res,true);
    print_r($res);
    //return $data;
}
httpCurl();