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
		display:absolute; width:75%; height:50%; border : 2.5px solid #0d4199; border-radius:10px;}
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
      $sql = "SELECT vaccine_table.vaccine_own_num FROM vaccine_table WHERE sysdate() < (expiration_date) AND vaccine_table.own_name='영남대병원' AND vaccine_table.use='N'";
      $ret = mysqli_query($con,$sql);
      $row= mysqli_fetch_array($ret);
      $vaccine_num = $row[0];
      //vaccine_own_num, production_date, expiration_date, company_name, own_name, use
      $sql = "UPDATE vaccine_table SET vaccine_table.use='"."Y"."' WHERE vaccine_own_num = '".$vaccine_num."'";
      $ret = mysqli_query($con,$sql);

   }
   $sql = "SELECT * FROM patient_table WHERE patient_table.pid='$pid' AND patient_table.hospital_name='영남대병원'";
   $ret = mysqli_query($con,$sql);
   $row=mysqli_fetch_array($ret);
   if(is_null($row))
   {
         $sql ="INSERT INTO patient_table VALUES('".$count."','".$patient_name."','".$pid."','"."영남대병원"."',
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
   
   }
   else
   {
      echo "이미 등록되어있는 환지입니다! <BR>";
      echo "<br> <a href ='yu.php'> <--메인화면</a>";
   }

  
   mysqli_close($con);
?>
</div>
</FORM>
</div>
</body>
</HTML>