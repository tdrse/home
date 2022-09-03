<?php
$f=$_GET['f'];
$t=$_GET['t'];
if(is_numeric($f) && is_numeric($t)){
for ($i=$f; $i<=$t; $i++)
{
    echo "&#" . $i ."[&#38;&#35;". $i ."]<br>" . PHP_EOL;
}
//༒ ༗
}else{?>
<html>
<meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover,user-scalable=no,target-densitydpi=device-dpi">
<title>&#65296;&#65297;&#65298;&#65299;&#65300;&#65301;&#65302;&#65303;&#65304;&#65305;</title>
<body>
<style>
*{
outline:none;
line-height:20px;
box-sizing:border-box;
}
body{
margin:0;
background:#f2f3f5;
}
div{
text-align:center;
padding:5px 10px 5px 10px;
}
.jf{
top:0;
width:100%;
padding:10px;
border:0px solid #fff;
border-radius:0px;
position:fixed;
background:#fff;
box-shadow:0px 1px 3px 0px rgba(120,120,120,.7);
}
input{
padding:10px;
width:100%;
font-size:16px;
max-width:600px;
background:#fff;
box-shadow:0px 1px 3px 0px rgba(120,120,120,.5);
border:0px solid #fff;
border-radius:5px;
}
</style>
<script>
function to(){
open("?f=" + document.getElementById('f').value + "&t=" + document.getElementById('t').value);
}
function dt(){
document.onkeydown=function(ev){
var event= ev || event;
if(event.keyCode==13){
open("?f=" + document.getElementById('f').value + "&t=" + document.getElementById('t').value);
}
}
}
</script>
<div class="jf">&# By tdrse</div>
<div style="padding:23px;"></div>
<div>
<input id="f" placeholder="from" onkeydown="dt()" value="<?php echo $f;?>">
</div>
<div>
<input id="t" placeholder="to" onkeydown="dt()" value="<?php echo $t;?>">
</div>
<div>
<input type="button" value="TO" onclick="to()">
</div>
</body>
</html>
<?}
?>