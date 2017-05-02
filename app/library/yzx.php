<?php
function yzx($id){
//载入ucpass类
require_once('./Ucpaas.class.php');

//初始化必填
$options['accountsid']='88a5d88dbeca3ac1d0e32a355e29dd2a';
$options['token']='72af76fa791519858d269fe4639766bd';


//初始化 $options必填
$ucpass = new Ucpaas($options);

//开发者账号信息查询默认为json或xml

echo $ucpass->getDevinfo('xml');


//语音验证码,云之讯融合通讯开放平台收到请求后，向对象电话终端发起呼叫，接通电话后将播放指定语音验证码序列
//$appId = "xxxx";
//$verifyCode = "1256";
//$to = "18612345678";

//echo $ucpass->voiceCode($appId,$verifyCode,$to);

//短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
$appId = "c1657bd321094f29b7a3482a88aec2d7";
$to = $id;
$templateId = "40154";
$code = rand(100000,999999);
$param=$code;

echo $ucpass->templateSMS($appId,$to,$templateId,$param);

return $param;
}