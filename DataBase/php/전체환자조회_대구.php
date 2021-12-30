<!doctype html>
<HTML>
<Head>
<META http-equiv="content-type" content="text/html; charset=utf-8">
<title>대구병원</title>
</Head>
<body>
<style>
a { color : black; text-decoration:none;}
em {text-align:center; font-style : normal; font-size : 13px; display:inline-block;}
img {display : inline-block; position: absolute; top:27px; left:20px}
h2{display : inline-block}
h5, h6 { display : inline-block }
h5 { color : #1d2975 }
#header{width:100%; height:80px; display : block; border-bottom : 1px solid #333}
.st {display : inline-block; color:#333}
.name { display : inline-block; position: absolute; top:15px; right:90px}
.logout {width: 60px; height:20px; background:#0756a0;
      display : inline-block; border-radius : 8px; color:white; float:right;
      position:absolute; top : 35px; right : 21px; font-size:13px; text-align:center}
 #content{position:absolute; top:12%; left:5%; }
 #form{position: absolute; top:23%; left : 5%; text-align :center;
      display:block; width:13%; height:70%; border : 2.5px solid #1d2975; border-radius:10px;}
 main { display : inline-block }
 #m{position: absolute; top:23%; left : 26%; text-align :center;
      display:block; width:60%; height:auto; border : 2.5px solid #1d2975; border-radius:10px;}
  .m_text{ position:relative; top:38%; right:2.8%}
 a{display : block; padding-top : 9%; padding-right : 2.5%}
</style>
<div id = "header">
<img src="대구병원로고.png" width = 200, height = auto>
<div class = "name">
<h5>오은영</h5><h6>선생님</h6>
</div>
<div class= "logout">
<button  type='button' onclick="location.href='admin.php'">logout</button >
</div>
</div>
<div id = "content">
<h2>  환자 정보 관리 </h2>
<div class = "st">
 <strong> - 환자 정보 조회, 수정, 삭제 </strong>
</div>
</div>
<div id = "main">
<div id = "form">
<a href="select_D.php">  ▶ 환자정보조회 </a>
<a href="전체환자조회_대구.php" style="color:blue"> ▶ 전체환자정보조회 </a>
<a href="insert_D.php" > ▶ 신규환자등록 </a> 
<a href="update_D.php" > ▶ 환자정보수정 </a>
<a href="delete_D.php" > ▶ 환자정보삭제 </a>
<a href="물품관리_대구.php" > ▶ 물품관리 </a>
</div>
<div id ="m">
<?php
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   $sql="USE govdb";
   $sql ="SELECT patient_table.patient_name, patient_table.pid, 
   patient_table.check_date, patient_table.COVID19_test_result, patient_table.COVID19_diagnosis,
   patient_table.hospitalization_date, patient_table.discharge_date, patient_table.death_date, patient_table.inoculation, 
   patient_table. vaccination_date,patient_table. vaccine_num, patient_table. breakthrough_infection
   FROM patient_table WHERE hospital_name = '대구병원'";
 
   $ret = mysqli_query($con, $sql);   
   if($ret) 
   {
      //echo mysqli_num_rows($ret), "건이 조회됨..<br><br>";
      $count = mysqli_num_rows($ret);
   }
   else {
      echo "userTBL 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   } 

   echo "<TABLE border=1>";
   echo "<TR>";
   echo "<TH>환자이름</TH><TH>주민등록번호</TH><TH>검사일</TH><TH>확진여부</TH>";
   echo "<TH>확진일</TH><TH>입원일</TH><TH>퇴원일</TH><TH>사망일</TH><TH>접종여부</TH><TH>접종날짜</TH><TH>접종한백신고유번호</TH><TH>돌파감염여부</TH>";
   echo "</TR>";
   
   while($row=mysqli_fetch_array($ret))
   {
   echo "<TR>";
   echo "<TD>", $row['patient_name'], "</TD>";
   echo "<TD>", $row['pid'], "</TD>";
   echo "<TD>", $row['check_date'], "</TD>";
   echo "<TD>", $row['COVID19_test_result'], "</TD>";
   echo "<TD>", $row['COVID19_diagnosis'], "</TD>";
   echo "<TD>", $row['hospitalization_date'], "</TD>";
   echo "<TD>", $row['discharge_date'], "</TD>";
   echo "<TD>", $row['death_date'], "</TD>";
   echo "<TD>", $row['inoculation'], "</TD>";
   echo "<TD>", $row['vaccination_date'], "</TD>";
   echo "<TD>", $row['vaccine_num'], "</TD>";
   echo "<TD>", $row['breakthrough_infection'], "</TD>";
   echo "</TR>";
   } 
   mysqli_close($con);
   echo "</TABLE>"; 
?>
</div>
</div>
</body>
</HTML>