<?php
header("content-type:text/html;charset=utf8");
/*$url="http://www.bwie.com/";
//引入snoopy类
include "./Snoopy.class.php";
$snoopy=new Snoopy;
//print_r($snoopy);
//获取网页内容
$snoopy->fetchform($url);
//表单提交地址
$action="http://www.bwie.com/plus/search.php";
//定义数组
$arr=array("q"=>"八维");
//模拟表单提交
$snoopy->submit($action,$arr);
echo $snoopy->results;*/
//引入snoopy类
/*include "./Snoopy.class.php";
$snoopy=new Snoopy;
$url="http://172.27.0.200/exam/index.php?m=Index&a=home";
$snoopy->fetch($url);
$this->results();*/
include "./Snoopy.class.php";
$url="https://mail.qq.com/cgi-bin/frame_html";
$snoopy=new snoopy;
//获取网页内容
$snoopy->fetch($url);
echo $snoopy->results;
?>