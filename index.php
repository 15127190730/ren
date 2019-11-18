<?php
include_once "wxBizMsgCrypt.php";
//define("AppID", "wxb9b907dd8e4bf31f");
//define("AppSecret", "2b1dd565cfad6a3b6cc069d5dcb4c369");
//define("TOKEN", "laopifu");
//define("EncodingAESKey", "39tWlDKmDQVxH8nPEd49TzGGAS1pKhmAj0sEbnIYWz0");
//
//
//$signature = $_GET["signature"];
//$timestamp = $_GET["timestamp"];
//$nonce     = $_GET["nonce"];
//
//$token  = TOKEN;
//$tmpArr = array($token, $timestamp, $nonce);
//sort($tmpArr);
//$tmpStr = implode($tmpArr);
//$tmpStr = sha1($tmpStr);
//
//if ($tmpStr == $signature) {
//    $echostr = $_GET["echostr"];
//    echo $echostr;
//} else {
//    return false;
//}
//
//
//$msg_signature = $_GET['msg_signature'];
//$encrypt_type  = (isset($_GET['encrypt_type']) && ($_GET['encrypt_type'] == 'aes')) ? "aes" : "raw";
//$postArr = file_get_contents("php://input");
//if ($encrypt_type == 'aes') {
//    $pc         = new WXBizMsgCrypt(TOKEN, EncodingAESKey, AppID);
//    $decryptMsg = "";  //解密后的明文
//    $errCode    = $pc->DecryptMsg($msg_signature, $timestamp, $nonce, $postArr, $decryptMsg);
//    $postArr    = $decryptMsg;
//}
//
//file_put_contents('aaa.txt', $postArr, FILE_APPEND);

?>