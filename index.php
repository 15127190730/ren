<?php
include_once "wxBizMsgCrypt.php";
define("AppSecret", "2b1dd565cfad6a3b6cc069d5dcb4c369");
responseMsg();
function responseMsg() {
    $appId          = 'wxb9b907dd8e4bf31f';
    $encodingAesKey = '39tWlDKmDQVxH8nPEd49TzGGAS1pKhmAj0sEbnIYWz0';
    $token          = "laopifu";

    $signature = $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce     = $_GET["nonce"];

    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr);
    $tmpStr = implode($tmpArr);
    $tmpStr = sha1($tmpStr);

    if ($tmpStr == $signature) {
        $echostr = $_GET["echostr"];
        echo $echostr;
    } else {
        return false;
    }


    $msg_signature = $_GET['msg_signature'];
    $encrypt_type  = (isset($_GET['encrypt_type']) && ($_GET['encrypt_type'] == 'aes')) ? "aes" : "raw";
    $postArr       = file_get_contents("php://input");
    if (!empty($postArr)) {
        if ($encrypt_type == 'aes') {
            $pc         = new WXBizMsgCrypt($token, $encodingAesKey, $appId);
            $decryptMsg = "";  //解密后的明文
            $errCode    = $pc->decryptMsg($msg_signature, $timestamp, $nonce, $postArr, $decryptMsg);
            if ($errCode == 0) {
                $postArr = $decryptMsg;
            }

        }
        $postObj = simplexml_load_string($postArr); //将xml数据转换为对象
        if (strtolower($postObj->MsgType) == 'text') {
            $keyword = trim($postObj->Content);

            if (!empty($keyword)) {
                if ($keyword == '123') {
                    $content = '老匹夫';
                }
            }
        }

        if (isset($content) && $content) {
            $info = responseText($postObj, $content);
            //加密
            if ($encrypt_type == 'aes') {
                $encryptMsg = ''; //加密后的密文
                $pc         = new WXBizMsgCrypt($token, $encodingAesKey, $appId);
                $errCode    = $pc->encryptMsg($info, $timestamp, $nonce, $encryptMsg);
                if ($errCode == 0) {
                    echo $encryptMsg;
                }

            }

        }
    }

}

//回复文字消息
function responseText($postObj, $content) {
    $toUser   = $postObj->FromUserName;
    $fromUser = $postObj->ToUserName;
    $time     = time();
    //返回文字消息的模板
    $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    </xml>";
    $info    = sprintf($textTpl, $toUser, $fromUser, $time, $content);
    return $info;
}

?>