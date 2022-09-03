<?php
/*
tdrse
tdrse@outlook.com
QQ: 3221965968
to.synergize.co
*/
$sc=$_GET['i'];
if($sc=="sc"){
$ncc=$_POST['infor'];
$mna=basename(__FILE__);
if($ncc==""){exit;}
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
if($ncc==$url){
echo "<script>top.location='$mna'</script>";
exit;}
if(strpos($ncc,'http://') !== false or strpos($ncc,'https://') !== false){ 
echo "<body style='margin:0;'><object style='width:100%;height:100%;' data='$ncc'></object></body>";
exit;
}else{
echo "<script>alert('请输入带协议的链接',top.location='$mna')</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en" onselectstart="return false">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="ico.ico"/>
    <title>URL搜索</title>
</head>
<body>
<style>
*{
box-sizing:border-box;outline:none;
}
body{
margin:0;
}
.inp{

}
iframe{
width:100%;
border:0;
height:100%;
border-top:3px solid #000;
position:absolute;
}
input{
background:#000;
color:#fff;
line-height:16px;
border:2px solid #000;
width:100%;
}
table,td{
padding:0;
background:#000;
border:0px solid #000;
}
</style>
<div class="inp" align="center">
<form action="?i=sc" method="post" target="na">
<table width="100%">
<td><input type="text" placeholder="搜索其实很简单…" name="infor"></td>
<td><input type="submit" value="搜索"></td>
</table>
</form>
</div>
<iframe id="iframe" allowfullscreen="allowfullscreen" name="na"></iframe>
<script>
</script>
</body>