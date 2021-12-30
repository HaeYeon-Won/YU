<HTML>
<Head>
<META http-equiv="content-type" content="text/html; charset=utf-8">
<title>영남대학교병원</title>
</Head>
<body>
<style>
a{display : block; padding-top : 9%; padding-right : 2.5%}
a { color : black; text-decoration:none;}
em {text-align:center; font-style : normal; font-size : 13px; display:inline-block;}
img {display : inline-block; position: fixed; top:27px; left:20px}
h2{display : inline-block}
h5, h6 { display : inline-block }
h5 { color : #0d4199 }
#header{width:100%; height:60px; display : block; border-bottom : 1px solid #333}
.ss {display : inline-block; color:#333; position : absolute; left : 90%}
.st {display : inline-block; color:#333}
.name { display : inline-block; position: absolute; top:5px; right:90px}
.logout {width: 60px; height:20px; background:#0d4199;
		display : inline-block; border-radius : 8px; color:white; float:right;
		position:absolute; top : 27px; right : 21px; font-size:13px; text-align:center}
 #content{position:absolute; top:12%; left:15%; display : inline-block}
 #form{position: absolute; top:20%; left : 15%; text-align :center;
		display:absolute; width:75%; height:50%; border : 2.5px solid #0d4199; border-radius:10px;}
 .form_text{ position:relative; top:38%; right:2.8%}
 
  #form2{
      display:absolute; width:50%; height:50%;  border-radius:10px;}
 .form_text_2{ position:relative; top:40%; right:-4%}
 .st { display : inline-block }
 .s {display : inline-block; color:#333; position : absolute; left : 85% ; top : 15%}
.st {display : inline-block; color:#333}
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
 <strong> - 환자 정보 삭제 </strong>
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
</div>
<div id = "form">
<?php
  $con=mysqli_connect("localhost","root","1234","govdb") or die("MySQL 접속 실패!");

  $patient_name = $_POST["patient_name"];
  $pid = $_POST["pid"];
  $check_date = $_POST["check_date"];
  $COVID19_test_result = $_POST["COVID19_test_result"];
  $COVID19_diagnosis = $_POST["COVID19_diagnosis"];   
  $hospitalization_date = $_POST["hospitalization_date"];  
  $discharge_date = $_POST["discharge_date"];
  $death_date = $_POST["death_date"];
  $inoculation = $_POST["inoculation"];
  $vaccination_date = $_POST["vaccination_date"];
  $vaccine_num = $_POST["vaccine_num"];
  $breakthrough_infection = $_POST["breakthrough_infection"]; 
  
 
$sql = "DELETE FROM patient_table WHERE pid = '".$_POST['pid']."' AND patient_table.hospital_name='영남대병원'";
  
  $ret = mysqli_query($con,$sql);
  echo "<h1> 환자 정보 삭제 결과</h1>"."<br><br><br>";
  if($ret)
  {
      echo "환자 정보가 정상적으로 삭제됨.";
      echo "<br> <a href ='yu.php'> <--메인화면</a>";
  }
  else{
      echo "정보 삭제 실패!!"."<br>";
      echo "실패원인 : ".mysqli_error($con);
  }
  mysqli_close($con);
  ?>
</div>
</BODY>
</HTML>