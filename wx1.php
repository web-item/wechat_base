<?php
/**
  * wechat php test
  */
//define your token
define("TOKEN", "someetweixin");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();
class wechatCallbackapiTest
{
 public function valid()
    {
        $echoStr = $_GET["echostr"];
        //valid signature , option
        if($this->checkSignature()){
         $this->responseMsg();
         exit;
        }
    }
    public function responseMsg()
    {
  //get post data, May be due to the different environments
  $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
       //extract post data
  if (!empty($postStr)){
                
               $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
    $msgType = "text";
                $textTpl = "<xml>
       <ToUserName><![CDATA[%s]]></ToUserName>
       <FromUserName><![CDATA[%s]]></FromUserName>
       <CreateTime>%s</CreateTime>
       <MsgType><![CDATA[%s]]></MsgType>
       <Content><![CDATA[%s]]></Content>
       <FuncFlag>0</FuncFlag>
       </xml>";             
    if(!empty( $keyword ))
                {
                
                 $contentStr = $this->keyrep($keyword);
     if(  empty($contentStr) )
     {
      $contentStr ="你是故意的吧，没文化真可怕";//你是故意的吧，没文化真可怕;
     }
     //$contentStr = @iconv('UTF-8','gb2312',$keyword);
                 $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                 echo $resultStr;
     
                }else{
                 $contentStr = '没文化真可怕，居然不会打字！';//$this->keyrep($keyword);
                 //$contentStr = @iconv('UTF-8','gb2312',$keyword);
     $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                 echo $resultStr;
                }
        }else {
         echo "";
         exit;
        }
    }
  
 private function checkSignature()
 {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"]; 
          
  $token = TOKEN;
  $tmpArr = array($token, $timestamp, $nonce);
  sort($tmpArr);
  $tmpStr = implode( $tmpArr );
  $tmpStr = sha1( $tmpStr );
  
  if( $tmpStr == $signature ){
   return true;
  }else{
   return false;
  }
 }
 
 function keyrep($key)
 {
  //return $key;
  if( $key=='嗨' || $key=='在吗' || $key=='你好' ){
    $mt = mt_rand(1,17);
    $array = array(1=>'自杀中，稍后再说...',2=>'有事找我请大叫！',3=>'我正在裸奔，已奔出服务区',4=>'我现在位置：WC； 姿势：下蹲； 脸部：抽搐； 状态：用力中。。。。',5=>'去吃饭了，如果你是帅哥，请一会联系我，如果你是美女...............就算你是美女，我也要先吃饱肚子啊',6=>' 
洗澡中~谢绝旁观！！^_^0',7=>'有熊出?]，我去诱捕，尽快回来。',8=>'你好，我是500，请问你是250吗？',9=>'喂！乱码啊，再发',10=>'
不是我不理你，只是时间难以抗拒！',11=>'你刚才说什么，我没看清楚，请再说一遍！',12=>'发多几次啊~~~发多几次我就回你。',13=>'此人已死，有事烧纸！',14=>'乖，不急哦…',15=>'你好.我去杀几个人,很快回来.',16=>'本人已成仙?有事请发烟?佛说有烟没火成不了正果?有火没烟成不了仙。',17=>'
你要和我说话？你真的要和我说话？你确定自己想说吗？你一定非说不可吗？那你说吧，这是自动回复，反正我看不见其实我在~就是不回你拿我怎么着？'
);
   return $array[$mt];
  
  }
  
  if( $key=='靠' || $key=='啊' || $key=='阿' )
  {
    $mt = mt_rand(1,19);
    $array = array(1=>'人之初?性本善?玩心眼?都滚蛋。',2=>'今后的路?我希望你能自己好好走下去?而我  坐车',3=>'笑话是什么?就是我现在对你说的话。',4=>'人人都说我丑?其实我只是美得不明显。',5=>'A;猪是怎么死的?B;你还没死我怎么知道',6=>' 
奥巴马已经干掉和他同姓的两个人?奥特曼你要小心了。 ',7=>'有的人活着?他已经死了?有的人活着?他早该死了。',8=>'"妹妹你坐船头?哥哥我岸上走"据说很傻逼的人看到都是唱出来的。',9=>'我这辈子只有两件事不会?这也不会?那也不会。',10=>'
过了这个村?没了这个店?那是因为有分店。',11=>'我以为你只是个球?没想到?你真是个球。',12=>'你终于来啦，我找你N年了，去火星干什么了？我现在去冥王星，回头跟你说个事，别走开啊',13=>'你有权保持沉默，你所说的一切都将被作为存盘记录。你可以请代理服务器，如果请不起网络会为你分配一个。',14=>'本人正在被国际刑警组织全球范围内通缉，如果您有此人的消息，请拨打当地报警电话',15=>'洗澡中~谢绝旁观！！^_^0',16=>'嘀，这里是移动秘书， 美眉请再发一次，我就与你联系；姐姐请再发两次，我就与你联系；哥哥、弟弟就不要再发了，因为发了也不和你联系！',17=>'
其实我在~就是不回你拿我怎么着？',18=>'你刚才说什么，我没看清楚，请再说一遍！',19=>'乖，不急。。。');
   return $array[$mt];
  }
  
  if( $key =='请问' )
  {
   $mt = mt_rand(1,5);
   $array = array(1=>'"我脸油吗"反光？?反正我不清楚',2=>'走，我请你吃饭',3=>'此人已死，有事烧纸！',4=>'喂！什么啊！乱码啊，再发',5=>'笑话是什么？?就是我现在对你说的话。');
   return $array[$mt];
  }
  
  return "";
  
 }
 
 function keylist()
 {
  $array  = array(1=>'嗨',2=>'你好',3=>'靠',4=>'在吗',5=>'请问');
 }
}
?>