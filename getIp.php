<?php
require('WechatToken.php');
require('WechatTpl.php');

$token = WechatToken::GetToken();
// 调用接口
// $push_url =  "https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=".$token;
// https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=ACCESS_TOKEN
$push_url =  "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=".$token;
// $openid = "oPs5ouLW3qg7P6CLj-jS7M1XVtSw";
// $dataWechatTpl =  WechatTpl::applyPass($openid);
// $dataWechatTpl = "";
// $param = json_encode($dataWechatTpl);
// $param = $dataWechatTpl;
$result = Curl::CurlGet($push_url);

// print_r($token);
print_r($result);