<?php
$lifeTime = 999 * 3600;
session_set_cookie_params($lifeTime); 
session_start();
date_default_timezone_set('PRC');
$nowtime=date("Ymd");
$tdr = $_GET['!'];
$cokname = $_SESSION['tdrunofs'];
$cokuid = $_SESSION['tdrper'];  /*cookie*/
$coksm = $_SESSION['tdrsmep'];
$udir="./user";
if(!is_dir($udir)) {
if(!mkdir($udir, 0775, true)) {error("系统错误");exit;}}
$namef = "$udir/$cokname.tdr.php";
if($_SESSION['tdrper']){
if($tdr=="logout"){  /*退出登录*/
unset($_SESSION['tdrunofs']);
unset($_SESSION['tdrper']);
unset($_SESSION['tdrsmep']);
echo "<script>top.location='./?!=login'</script>";}
if(!file_exists($namef)){   /*验证用户*/
echo "<script>alert('账号信息出错！',top.location='?!=logout')</script>";
exit;}
require $namef;
if($cokuid !== $uid) {   /*验证用户*/
echo "<script>alert('账号信息出错！',top.location='?!=logout')</script>";
exit;}
if($coksm !== $sm) {   /*验证用户*/
echo "<script>alert('账号信息出错！',top.location='?!=logout')</script>";
exit;}
if($tdr=="content"){  /*发帖代码*/
$con=$_POST['content'];
echo "<script>alert('$con！')</script>";
}
}
if(!$_SESSION['tdrper']){
if($tdr=="logc"){  /*登录代码*/
$username = $_POST['username'];
$password = md5($_POST['password']);
$username = strip_tags($username);
$username = htmlspecialchars($username); 
$username = addslashes($username);
if ($username=="" && $password=="d41d8cd98f00b204e9800998ecf8427e") {exit;}
if($username=="" & $password !=="d41d8cd98f00b204e9800998ecf8427e"){
echo "<script>alert('请输入用户名！')</script>";
exit;}
$namef = "$udir/$username.tdr.php";
if(!file_exists($namef)){
echo "<script>alert('没有此用户！')</script>";
exit;}
require "$udir/$username.tdr.php";
if ($password=="$pw") {
$_SESSION['tdrunofs']=$username;
$_SESSION['tdrper']=$uid;
$_SESSION['tdrsmep']=$sm;
echo "<script>alert('登录成功！',top.location='./')</script>";
}else{echo "<script>alert('账号或密码不正确！')</script>";}
}
if($tdr=="regc"){   /*注册代码*/
$unkp=$_POST['username'];
$tun=preg_replace('# #','',$unkp);
$nasu=mb_strlen($tun, 'UTF-8');
$username=$tun;
$repw=$_POST['password'];
$nprd=preg_replace('# #','',$repw);
$pasu=mb_strlen($nprd, 'UTF-8');
$towp=md5($_POST['towpass']);
$password=md5($nprd);
$day = time();
$fil="num.txt";
$namef = "$udir/$username.tdr.php";
if(file_exists($namef)){
echo "<script>alert('用户已存在！',top.location='./?!=register')</script>";
exit;}
if($nasu > "10" or $pasu > "32" or $pasu < "6" && $pasu >= "1"){
echo "<script>alert('账号(密码)不符合要求！',top.location='./?!=register')</script>";
exit;}
if($repw !== $nprd or $unkp !== $tun){
echo "<script>alert('账号(密码)不能含有空格！',top.location='./?!=register')</script>";
exit;}
if($username=="" && $password=="d41d8cd98f00b204e9800998ecf8427e" or $repw=""){exit;}
if($username !=="" & $password=="d41d8cd98f00b204e9800998ecf8427e"){
echo "<script>alert('请输入密码！')</script>";
exit;}
if($username=="" & $password !=="d41d8cd98f00b204e9800998ecf8427e"){
echo "<script>alert('请输入用户名！')</script>";
exit;}
if(is_numeric($nprd)){
echo "<script>alert('请勿设置纯数字的密码！$tokp',top.location='./?!=register')</script>";
exit;}
if($towp !== $password){
echo "<script>alert('两次密码不一致！',top.location='./?!=register')</script>";
exit;}
$sepas=md5('tdr'.$password);
if(!file_exists($fil)){
$fp=fopen($fil,"w");
fputs($fp,"0");
fclose($fp);
}
$fp=fopen($fil,"r");
$hits=fgets($fp,1024);
fclose($fp);
$hits=$hits + 1;
$hits=(string)$hits;
$fp=fopen($fil,"w");
fputs($fp,$hits);
fclose($fp);
for($i=0;$i<10;$i++)
$hits = str_replace("$i","$i","$hits");
$user=$udir."/".$username.".tdr.php";
$u="$"."un=";
$p="$"."pw=";
$d="$"."uid=";
$s="$"."sm=";
$usq="<?php $u'$username';$p'$password';$d'$hits';$s'$sepas';?>";
if(!file_exists($user)){
$fp=fopen($user,"w");
fputs($fp,$usq);
fclose($fp);
echo "<script>alert('注册成功！',top.location='./?!=login')</script>";
}else{
echo "<script>alert('注册失败！',top.location='./?!=register')</script>";
exit;}
}
}
?>
<!DOCTYPE html>
<html lang="en" onselectstart="return false">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="ico.ico"/>
    <iframe id="iframe" hidden name="na"></iframe>
    <meta name="description" content="社区">
    <meta name="keywords" content="微社区, 微论坛">
<style>
*{
webkit-text-size-adjust: none;
-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
outline:none;
box-sizing: border-box;
}
html{
color:#555;
font-size:14px;
font-family:sans-serif;
}
body{
margin:0;
background-color: #f7f7f7;
}
a {
text-decoration: none !important;
color:#555;
}
p{
margin-bottom:0px;
font-size:15px;
line-height:25px;
overflow: hidden;
text-overflow: ellipsis;
word-spacing: normal;
word-break: break-word;
word-wrap: break-word;
}
#top{
display:none;
padding:3px 5px 3px;
background-color:#f7f7f7;
color:#555;
cursor:pointer;
position:fixed;
right:10px;
bottom:10px;
}
#head{
position:fixed;
top:20px;
left:20px;
background-color:#fff;
font-weight:bold;
}
.btn{
background-color:#fff;
border:1px solid #f7f7f7;
border-radius:10px;
padding:10px;
margin:5px;
box-shadow: 0 0px 1px 0px rgba(238, 238, 238, .75);
transition:background-color 0.2s;
}
.btn:hover{
background-color:#f7f7f7;
}
@media only screen and (min-width:767px){  <?php /*桌面端*/ ?>
html{
margin-top:0px;
padding:20px;
}
.fan{
text-align:center;
}
.login{
max-width:500px;
text-align:center;
}
.register{
max-width:500px;
text-align:center;
}
.btn{
border-radius:30px;
}
#head{
border-radius:30px;
padding:20px;
font-size:14px;
}
#lou{
background-color:#fff;
border-radius:30px;
padding:20px;
font-size:14px;
}
#main{
background-color:#fff;
box-sizing:border-box;
border-radius:30px;
width:45%;
}
}
@media only screen and (max-width:767px){  <?php /*移动端*/ ?>
#head{
border:0.5px solid #f7f7f7;
border-radius:10px;
padding:10px;
box-shadow: 0 0px 1px 0px rgba(238, 238, 238, .75);
transition:background-color 0.2s;
}
#lou{
padding:5px;
line-height:25px;
dialpay:inline;
transition:background-color 0.2s;
}
#head:active,
#lou:active{
background-color:#f7f7f7;
}
#main{
background-color:#fff;
padding:10px;
margin:10px;
border-radius:10px;
box-shadow: 0 4px 4px 0px rgba(238, 238, 238, .75);
}
#index{
background-color:#fff;
position:fixed;
top:0;
padding:5px;
width:100%;
box-shadow: 0 4px 4px 0px rgba(238, 238, 238, .75);
}
.hd{
margin-top:60px;
}
}
</style>
<script><?php require "./tdr/jquery.js"; /*引入JS*/ ?></script>
</head>
<body>
<div class="hd"><div id="index">
<table><td><div id="lou"><a href="./">TDR社区</a></div></td>
<?php 
if($_SESSION['tdrper']){
?>
<td><a href="?!=mine"><div id="lou">个人</div></a></td>
<td><div id="lou">昵称:<?php echo $un;?></div></td></table>
<?php }else{?>
<td><a href="?!=login"><div id="lou">注册</div></a></td></table>
<?php };?>
</div></div>
<?php
if(!$_SESSION['tdrper']){
if($tdr=="login"){ /*登录*/
login();
exit;
}
if($tdr=="register"){ /*注册*/
register();
exit;
}}
if($_SESSION['tdrper']){
if($tdr=="mine"){ /*我的*/
mine();
exit;
}
if($tdr=="take"){ /*发帖*/
take();
exit;
}}
if($tdr=="404"){ /*404*/
notfound();
exit;
}
else{ /*主页*/
index();
}
?>
<div id="top">∧</div>
<script type="text/javascript">
  $(window).scroll(function(){var sc=$(window).scrollTop();
  var rwidth=$(window).width()+$(document).scrollLeft();
  var rheight=$(window).height()+$(document).scrollTop();
  if(sc>0)$('#top').css('display','block');
  else $('#top').css('display','none');});
$("#top").click(function(){$('body,html').animate({scrollTop:0},300);});
</script>
<?php 
function login(){   /*登录*/
?>
<?php
?>
<style>
*{outline:none;color:#555;}
.login{
margin-bottom:10px;
border-radius:0px;
padding:10px;
width:100%;
background:#f7f7f7;
box-sizing:border-box;
border:0px solid #555;
border-left:2px solid #555;
transition:border 0.5s;
}
.login:hover{
border-left:15px solid #555;
}
.fan{
margin-bottom:10px;
border-radius:0px;
padding:8px;
float:right;
width:100px;
background:#f7f7f7;
box-sizing:border-box;
border:0px solid #555;
border-left:2px solid #555;
transition:border 0.5s;
}
.fan:active{
border-left:20px solid #555;
}
.user{
text-align:center;
margin-bottom:10px;
}
.dl{
font-size:30px;
padding-bottom:20px;
}
.dl a{
font-size:14px;
padding-bottom:20px;
}
</style>
<title>登录</title>
</head>
<body>
<div id="main" style="padding:20px">
<div class="dl">登录<a>TDR社区</a></div>
<div class="user"><svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="100.000000px" height="100.000000px" viewBox="0 0 500.000000 500.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,500.000000) scale(0.100000,-0.100000)" fill="#555" stroke="none"><path d="M2370 4994 c-309 -36 -536 -112 -753 -251 -594 -380 -887 -1067 -747 -1752 81 -398 312 -758 633 -990 45 -33 90 -66 100 -73 17 -12 11 -17 -65 -47 -485 -195 -942 -591 -1227 -1064 -115 -191 -246 -514 -286 -708 -9 -41 -18 -82 -21 -91 -5 -17 9 -18 204 -18 l209 0 23 88 c195 743 788 1326 1538 1512 327 81 667 84 1002 10 763 -169 1374 -759 1581 -1527 l22 -83 209 0 208 0 -6 28 c-57 253 -114 423 -214 627 -123 254 -281 476 -480 675 -233 234 -519 425 -816 544 l-107 43 29 19 c372 238 636 622 724 1056 97 472 -13 959 -303 1343 -258 342 -649 577 -1072 644 -75 12 -327 22 -385 15z m334 -430 c513 -89 916 -480 1021 -990 98 -475 -115 -997 -519 -1268 -220 -148 -446 -217 -706 -218 -933 0 -1541 1000 -1106 1818 74 138 115 194 225 305 155 155 324 257 530 319 162 50 388 64 555 34z"/></g></svg></div>
<form action="?!=logc" method="post" name="myform" target="na"><center>
<input class="login" type="text" name="username" placeholder="用户名"><br>
<input class="login" type="password" name="password" placeholder="密码"></center>
<input class="fan" type="submit" value="立即登录">
</form>
<div style="font-size:14px;color:#777"><a onclick="location='?!=register';" target="na">注册一个账号＞</a></div><br>
</div>
</div>
<?php };
?>
<?php 
function register(){   /*注册*/
?>
<?php
?>
<style>
*{outline:none;color:#555;}
.register{
margin-bottom:10px;
border-radius:0px;
padding:10px;
width:100%;
background:#f7f7f7;
box-sizing:border-box;
border:0px solid #555;
border-left:2px solid #555;
transition:border 0.5s;
}
.register:hover{
border-left:15px solid #555;
}
.fan{
margin-bottom:10px;
border-radius:0px;
padding:8px;
float:right;
width:100px;
background:#f7f7f7;
box-sizing:border-box;
border:0px solid #555;
border-left:2px solid #555;
transition:border 0.5s;
}
.fan:active{
border-left:20px solid #555;
}
.user{
text-align:center;
margin-bottom:10px;
}
.dl{
font-size:30px;
padding-bottom:20px;
}
.dl a{
font-size:14px;
padding-bottom:20px;
}
</style>
<title>注册</title>
</head>
<body>
<div id="main" style="padding:20px">
<div class="dl">注册<a>TDR社区</a></div>
<form action="?!=regc" method="post" target="na"><center>
<input class="register" autocomplete="off" type="text" name="username" placeholder="用户名 1～10位" maxlength="10"><br>
<input class="register" autocomplete="off" type="password" name="password" placeholder="密码 6～32位" maxlength="32"></center>
<input class="register" autocomplete="off" type="password" name="towpass" placeholder="确认密码" maxlength="32"></center>
<input class="fan" autocomplete="off" type="submit" value="立即注册">
</form>
<div style="font-size:14px;color:#777"><a onclick="location='?!=login';">＜返回登录</a></div><br>
</div>
</div>
<?php };?>
<?php 
function notfound(){  /*404页*/
?>
<title>错误</title>
<div id="main" style="padding:20px;">
页面未找到≧∇≦
</div>
<?php };?>
<?php 
function index(){  /*主页*/
?>
<title>主页</title>
<?php };?>
<?php 
function mine(){  /*我的*/
?>
<title>我的</title>
<style>
</style>
<div id="main" style="padding:10px;">
<div style="">用户名:<?php echo $_SESSION['tdrunofs']?></div>
<div style="">UID:<?php echo $_SESSION['tdrper']?></div>
</div>
<div id="main" style="padding:5px;">
<a href="?!=take"><div class="btn">发表</div></a>
<div class="btn">文章</div>
<a href="?!=logout"><div class="btn">退出</div></a>
</div>
<div id="main" style="padding:10px;">

</div>
<?php };?>
<?php 
function take(){  /*发帖*/
?>
<title>发帖</title>
<style>
textarea{
width:100%;
background-color:#fff;
border:1px solid #f7f7f7;
border-radius:10px;
padding:10px;
min-height:300px;
color:#555;
resize:vertical;
line-height:20px;
font-family:sans-serif;
font-size:14px;
box-shadow: 0 0px 1px 0px rgba(238, 238, 238, .75);
transition:background-color 0.2s;
}
textarea:hover{
background-color:#f7f7f7;
}
#nowtime{
font-weight:300;
margin-bottom:10px;
}
</style>
<script>
window.onload=function(){  <?php /*获取当前时间*/?>
setInterval("NowTime()",200);}
function NowTime(){
var time=new Date();
var year=time.getFullYear();
var month=time.getMonth() + 1;
var day=time.getDate();                
var h=time.getHours();
var m=time.getMinutes();
var s=time.getSeconds();
h=check(h);
m=check(m);
s=check(s);
document.getElementById("nowtime").innerHTML="当前时间: "+h+":"+m+":"+s;
}
function check(i){
var num;
 i < 10 ? num = "0" + i : num = i;
return num;
}
</script>
<form id="form" target="na">
<div id="main" style="padding:10px;">
<textarea name="content"><?php echo $text;?></textarea>
</div>
<div id="main" style="padding:10px"><div id="nowtime">当前时间: 00:00:00</div>
<div class="btn" style="margin:0" id="submit">发表</div>
</div>
<form>
<script>
$("#submit").click(function(){
    $.ajax({
    url:'?!=content',
    type:"POST",
    data:$('#form').serialize(),
    success:function(data){
        }
        setTimeout(function (){
            window.location.href="./";
        }, 1000);
    }
    });
});
</script>
<?php };?>