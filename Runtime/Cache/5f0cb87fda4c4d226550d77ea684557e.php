<?php if (!defined('THINK_PATH')) exit();?><html>

<head>
<script type="text/javascript">
var dd=new Date();
document.getElementById("login").innerHTML="1234567";
var kk=aa.getHours()*60+aa.getMinutes();

function show(kk){
var aa=new Date();

bb=aa.getYear()+"年"+(aa.getMonth()+1)+"月"+aa.getDate()+"日\r";
bb+="星期"+'日一二三四五六'.charAt(aa.getDay())+"\r"+aa.getHours()+"时";
bb+=aa.getMinutes()+"分"+aa.getSeconds()+"秒";


document.all.cc.innerHTML=bb;
document.all.login.innerHTML=kk;

setTimeout("show()",1000)
}


</script>
<body onload=show()>
<div id="cc"></div>
<div id="login"></div>

</html>