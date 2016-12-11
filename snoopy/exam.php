<?php
header("content-type:text/html;charset=utf8");//防乱码
include("Snoopy.class.php");//引入类
$snoopy=new Snoopy;//实例化
$url="http://172.27.0.200/exam/index.php?m=Index&a=login";//登录路径
//$url=Iconv('gbk','utf8',$url);
$arr=array('username'=>"1409phpE0032",'password'=>'1265');//获取用户名密码
$snoopy->cookies["PHPSESSID"]='vtuemtf31sqo5qc57t0d6st942';//伪装session id
$snoopy->submit($url,$arr);//表单提交
$snoopy->fetch("http://172.27.0.200/exam/index.php?m=Index&a=home");
echo $snoopy->results;