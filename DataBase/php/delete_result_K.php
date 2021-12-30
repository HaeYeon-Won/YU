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
로그아웃
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
  
 
  $sql = "DELETE FROM patient_table WHERE pid = '".$_POST['pid']."' AND patient_table.hospital_name='경북대병원'";
  
  $ret = mysqli_query($con,$sql);
  echo "<h1> 환자 정보 삭제 결과</h1>";
  if($ret)
  {
      echo "<br>"."환자 정보가 정상적으로 삭제됨.";
      echo "<br> <a href ='knu.php'> <--메인화면</a>";
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