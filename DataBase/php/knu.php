<!doctype html>
<HTML>
<Head>
<META http-equiv="content-type" content="text/html; charset=utf-8">
<title>경북대학교병원</title>
</Head>
<body>
<style>
em {text-align:center; font-style : normal; font-size : 13px; display:inline-block;}
img {display : inline-block; position: fixed; top:300px; left:295px}
h1{display : inline-block}
h5, h6 { display : inline-block }
h5 { color : black }
#header{width:100%; height:60px; display : block; }
.st {display : inline-block; color:#333}
.name { display : inline-block; position: absolute; top:5px; right:90px}
.logout {width: 60px; height:20px; background:#0d4199;
		display : inline-block; border-radius : 8px; color:white; float:right;
		position:absolute; top : 27px; right : 21px; font-size:13px; text-align:center}
 #content{position:absolute; top:10%; left:15%; }
 n {display:inline-block}
 #form{position: absolute; top:20%; left : 15%; text-align :center;
		display:absolute; width:70%; height:60%; border : 2.5px solid #d80c18; border-radius:10px;}
.form_text{ position:relative; top:38%; left:10%}
.sss {display : inline-block; color:#333; position : absolute; left : 70% ; }
 .s {display : inline-block; color:#333; position : absolute; left : 75% ; top : 15%}
</style>
<div id = "header">
<img src="경북대학교병원로고.png" width = 200, height = auto>
<div class = "name">
<h5>오은영</h5><h6>선생님</h6>
</div>
<div class= "logout">
<button  type='button' onclick="location.href='admin.php'">logout</button >
</div>
</div>
<div id = "content">
<h1>  환자 정보 관리 </h1>
<div class = "st">
 <strong><h3> - 환자 정보 조회 </h3></strong>
</div>
</div>
<div class = "s">
<button  type='button' onclick="location.href='물품관리_경북대.php'">물품관리</button >
<button  type='button' onclick="location.href='insert_K.php'">새로운 환자 추가</button >
<button  type='button' onclick="location.href='knu.php'">main화면</button >
</div>
<div id = "form">
<FORM METHOD="get" ACTION="select_K.php" class="form_text">
	<em>성함</em> : <INPUT TYPE = "text" NAME="patient_name"><br>
	<em>주민등록번호</em> : <INPUT TYPE = "text" NAME="pid">
	<INPUT TYPE="submit" VALUE="조회">
<div class = "sss">
<button  type='button' onclick="location.href='전체환자조회_경북대.php'">전체환자조회하기</button >
</div>
</FORM>
</div>
</body>
</HTML>