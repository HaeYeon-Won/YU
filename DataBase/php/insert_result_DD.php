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
		display:block; width:60%; height:70%; border : 2.5px solid #1d2975; border-radius:10px;}
  .m_text{ position:relative; top:38%; right:2.8%}
 a{display : block; padding-top : 9%; padding-right : 2.5%}
</style>
<div id = "header">
<img src="대구병원로고.png" width = 200, height = auto>
<div class = "name">
<h5>오은영</h5><h6>선생님</h6>
</div>
<div class= "logout">
로그아웃
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
<a href="select_D.php" > ▶ 환자정보조회 </a>
<a href="전체환자조회_대구.php" > ▶ 전체환자정보조회 </a>
<a href="insert_D.php" style="color:blue"> ▶ 신규환자등록 </a>
<a href="update_D.php" > ▶ 환자정보수정 </a>
<a href="delete_D.php" > ▶ 환자정보삭제 </a>
<a href="물품관리_대구.php" > ▶ 물품관리 </a>
</div>
<div id ="m">
<?php
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");

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


   $sql_2 = "SELECT count(patient_table.patient_num) FROM patient_table";
   $result_set = mysqli_query($con,$sql_2);
   $row=mysqli_fetch_array($result_set);
   $count= (int)$row[0]+1;
   if($inoculation!=0)
   {
      $sql = "SELECT vaccine_table.vaccine_own_num FROM vaccine_table WHERE sysdate() < (expiration_date) AND vaccine_table.own_name='대구병원' AND vaccine_table.use='N'";
      $ret = mysqli_query($con,$sql);
      $row= mysqli_fetch_array($ret);
      $vaccine_num = $row[0];
      //vaccine_own_num, production_date, expiration_date, company_name, own_name, use
      $sql = "UPDATE vaccine_table SET vaccine_table.use='"."Y"."' WHERE vaccine_own_num = '".$vaccine_num."'";
      $ret = mysqli_query($con,$sql);

   }
   $sql = "SELECT * FROM patient_table WHERE patient_table.pid='$pid' AND patient_table.hospital_name='대구병원'";
   $ret = mysqli_query($con,$sql);
   $row=mysqli_fetch_array($ret);
   if(is_null($row))
   {
         $sql ="INSERT INTO patient_table VALUES('".$count."','".$patient_name."','".$pid."','"."대구병원"."',
      '".$check_date."','".$COVID19_test_result."','".$COVID19_diagnosis."','".$hospitalization_date."','".$discharge_date."',
      '".$death_date."','".$inoculation."',
      '".$vaccination_date."','".$vaccine_num."','".$breakthrough_infection."')";

      $ret = mysqli_query($con, $sql);   
      echo "<h1> 신규 환자 입력 결과</h1>"."<br><br><br>";
      if($ret)
      {
      echo "환자 정보가 성공적으로 입력됨";
      }
      else
      {
         echo "데이터 1입력 실패!"."<br>";
         echo "실패 원인: ".mysqli_error($con);
         $sql = "UPDATE vaccine_table SET vaccine_table.use='"."N"."' WHERE vaccine_own_num = '".$vaccine_num."'";
         $ret = mysqli_query($con,$sql);
      
      }
      echo "<br> <a href ='daegu.php'> <--메인화면</a>";
   
   }
   else
   {
      echo "이미 등록되어있는 환지입니다! <BR>";
      echo "<br> <a href ='daegu.php'> <--메인화면</a>";
   }

  
   mysqli_close($con);
   echo "<br> <a href ='daegu.php'> <-- 메인 화면</a>";
?>
</BODY>
</HTML>