<HTML>
<Head>
<title>영남대학교병원</title>
<METAhttp-equiv="content-type" content="text/html; charset=utf-8">
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
.st {display : inline-block; color:#333}
.name { display : inline-block; position: absolute; top:5px; right:90px}
.logout {width: 60px; height:20px; background:#0d4199;
      display : inline-block; border-radius : 8px; color:white; float:right;
      position:absolute; top : 27px; right : 21px; font-size:13px; text-align:center}
 #content{position:absolute; top:12%; left:15%; }
 #form{position: absolute; top:20%; left : 15%; text-align :center;
      display:absolute; width : 75%; height:50%; border : 2.5px solid #0d4199; border-radius:10px;}
 .form_text{ position:relative; top:38%; right:2.8%}
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
<?php
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");

   // 필요없는 부분은 삭제하면 됨
   $sql ="SELECT patient_table.patient_num, patient_table.patient_name, patient_table.pid, 
   patient_table.check_date, patient_table.COVID19_test_result, patient_table.COVID19_diagnosis,
   patient_table.hospitalization_date, patient_table.discharge_date, patient_table.death_date, patient_table.inoculation, 
   patient_table. vaccination_date,patient_table. vaccine_num, patient_table. breakthrough_infection
   FROM patient_table WHERE pid='".$_GET['pid']."' AND patient_name='".$_GET['patient_name']."' AND hospital_name = '영남대병원'";
 
   $ret = mysqli_query($con, $sql);   
   if($ret)
   {
      $count = mysqli_num_rows($ret);
      if($count==0){
         echo $_GET['pid']." 해당하는 환자가 없음!!"."<br>";
         echo "<br> <a href='yu.php'> <--초기 화면</a> ";
         exit();
      }
   }
   else
   {
      echo "데이터 조회 실패!"."<br>";
      echo "실패 원인: ".mysqli_error($con);
      echo "<br> <a href ='yu.php'> <--메인화면</a>";
      exit();
   }

   echo "<TABLE border=1>";
   echo "<TR>";
   echo "<TH>환자이름</TH><TH>주민등록번호</TH><TH>검사일</TH><TH>확진여부</TH>";
   echo "<TH>확진일</TH><TH>입원일</TH><TH>퇴원일</TH><TH>사망일</TH><TH>접종여부</TH><TH>접종날짜</TH><TH>접종한백신고유번호</TH><TH>돌파감염여부</TH><TH>수정</TH><TH>삭제</TH>";
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
   echo "<TD>", "<a href='update.php?pid=",$_GET['pid'],  "'>수정</a></TD>";
  
   echo "<TD>", "<a href='delete.php?pid=",$_GET['pid'],  "'>삭제</a></TD>";
   echo "</TR>";
   }   
   mysqli_close($con);
   echo "</TABLE>"; 
?>
</FORM>
</div>
</body>
</HTML>