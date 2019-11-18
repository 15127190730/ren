<?php

    $signature = $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce = $_GET["nonce"];

    $token = 'laopifu';
    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );

    if( $tmpStr == $signature ){
        $echostr = $_GET["echostr"];
        echo $echostr;
    }else{
        return false;
    }


$postArr =  file_get_contents("php://input");
file_put_contents('aaa.txt', $postArr,FILE_APPEND);

?>