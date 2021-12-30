<HTML>
<Head>
<META http-equiv="content-type" content="text/html; charset=utf-8">
<title>영남대학교병원</title>
</Head>
<body>
<style>
a{display : block; padding-top : 9%; padding-right : 2.5%}
a { color : black; text-decoration:none;}
img {display : inline-block; position: fixed; top:27px; left:20px}
h2{display : inline-block}
h5, h6 { display : inline-block }
h5 { color : #0d4199 }
#header{width:100%; height:60px; display : block; border-bottom : 1px solid #333}
.ss {display : inline-block; color:#333; position : absolute; left : 85% ; }
.sss {display : inline-block; color:#333; position : absolute; left : 70% ; }
.st {display : inline-block; color:#333}
.name { display : inline-block; position: absolute; top:5px; right:90px}
.logout {width: 60px; height:20px; background:#0d4199;
		display : inline-block; border-radius : 8px; color:white; float:right;
		position:absolute; top : 27px; right : 21px; font-size:13px; text-align:center}
 #content{position:absolute; top:12%; left:15%; display : inline-block}
 #form{position: absolute; top:20%; left : 15%; text-align :center;
		display:absolute; width:75%; height:auto; border : 2.5px solid #0d4199; border-radius:10px;}
 .form_text{ position:relative; top:38%; right:2.8%}
 
  #form2{
      display:absolute; width:50%; height:50%;  border-radius:10px;}
 .st { display : inline-block }
 .s {display : inline-block; color:#333; position : absolute; left : 85% ; top : 15%}
  #sub{position: absolute; top:20%; left : 2%; text-align :center; background : #0d4199;
		display:block; width:11%;height:30%; border : 2.5px solid #0d4199; border-radius:10px; color:white}
  #main { display : inline-block }

</style>
<div id = "header">
<img src="영남대학교병원로고.png" width = 200, height = auto>
<div class = "name">
<h5>오은영</h5><h6>선생님</h6>
</div>
<div class= "logout">
<button  type='button' onclick="location.href='admin.php'">logout</button >
</div>
</div>
<div id = "content">
<h2> | 환자 정보 관리 </h2>
<div class = "st">
 <strong> - 환자 정보 조회 </strong>
</div>
</div>
<div id = "main">
<div id ="sub">
<BR>
MENU ▼ 
<a href="전체환자조회_영대.php" style="color:white">  전체환자조회 </a>
<a href="insert.php" style="color:white">  신규환자등록 </a>
<a href="물품관리_영대.php" style="color:white">  물품관리 </a>
<a href="yu.php" style="color:white">  main화면 </a>
</div>
</div>

<div id = "form">
<h1> 신규 환자 입력</h1>
<FORM METHOD="post" ACTION="insert_result.php">
      
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