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
		display:absolute; width:70%; height:auto; border : 2.5px solid #d80c18; border-radius:10px;}
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
<h1> 신규 환자 입력</h1>
<FORM METHOD="post" ACTION="insert_result_K.php">
      
      환자 이름 : <INPUT TYPE = "text" NAME="patient_name"> <br>
      주민 번호 : <INPUT TYPE = "text" NAME="pid">  <br>
      검사일    : <INPUT TYPE = "text" NAME="check_date"> <br>
      코로나 확진여부 : <INPUT TYPE = "text" NAME="COVID19_test_result"> <br>
      확진일    : <INPUT TYPE = "text" NAME="COVID19_diagnosis"> <br>
      입원일    : <INPUT TYPE = "text" NAME="hospitalization_date"> <br>
      퇴원일    : <INPUT TYPE = "text" NAME="discharge_date"> <br>
      사망일    : <INPUT TYPE = "text" NAME="death_date"> <br>
      접종 여부 : <INPUT TYPE = "text" NAME="inoculation"> <br>
      접종 날짜 : <INPUT TYPE = "text" NAME="vaccination_date"> <br>
      접종한 백신 고유번호 : <INPUT TYPE = "text" NAME="vaccine_num"> <br>
      돌파감염여부 : <INPUT TYPE = "text" NAME="breakthrough_infection"> <br>
      <BR><BR>
      위 환자 정보를 입원 등록 하시겠습니까?
      <INPUT TYPE="submit" VALUE="환자 입원 등록">
</FORM>
</div>
</FORM>
</div>
</body>
</HTML>