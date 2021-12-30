<HTML>
<Head>
<META http-equiv="content-type" content="text/html; charset=utf-8">
<title>대구병원</title>
</Head>
<body>
<style>
a { color : black; text-decoration:none;}
em {text-align:center; font-style : normal; font-size : 13px; display:inline-block;}
img {display : inline-block; position: fixed; top:27px; left:20px}
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
<a href="insert_D.php" > ▶ 신규환자등록 </a> 
<a href="update_D.php" style="color:blue" > ▶ 환자정보수정 </a>
<a href="delete_D.php" > ▶ 환자정보삭제 </a>
<a href="물품관리_대구.php" > ▶ 물품관리 </a>
</div>
<div id ="m">
<?php
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   $sql ="SELECT * FROM patient_table WHERE pid = '".$_GET['pid']."' AND patient_table.hospital_name='대구병원'";

   $ret = mysqli_query($con, $sql);   
   if($ret){
     $count = mysqli_num_rows($ret);
     if($count==0){
        echo $_GET['pid']." 해당하는 환자가 없음!!"."<br>";
        echo "<br> <a href='daegu.php'> <--초기 화면</a> ";
        exit();
     }
  }
  else{
     echo "데이터 조회 실패!"."<br>";
     echo "실패 원인: ".mysqli_error($con);
     echo "<br> <a href ='daegu.php'> <--메인화면</a>";
     exit();
  }
   $row = mysqli_fetch_array($ret);
   $patient_num = $row['patient_num'];
   $patient_name = $row["patient_name"];
   $pid = $row["pid"];
   $check_date = $row["check_date"];
   $COVID19_test_result = $row["COVID19_test_result"];
   $COVID19_diagnosis = $row["COVID19_diagnosis"];   
   $hospitalization_date = $row["hospitalization_date"];  
   $discharge_date = $row["discharge_date"];
   $death_date = $row["death_date"];
   $inoculation = $row["inoculation"];
   $vaccination_date = $row["vaccination_date"];
   $vaccine_num = $row["vaccine_num"];
   $breakthrough_infection = $row["breakthrough_infection"];    
?>

<FORM METHOD="post" ACTION="update_result_D.php">
      환자 번호 : <INPUT TYPE = "text" NAME="patient_num" VALUE=<?php echo $patient_num ?> READONLY> <br>
      환자 이름 : <INPUT TYPE = "text" NAME="patient_name" VALUE=<?php echo $patient_name ?>> <br>
      주민 번호 : <INPUT TYPE = "text" NAME="pid" VALUE=<?php echo $pid ?> READONLY>  <br>
      검사일    : <INPUT TYPE = "text" NAME="check_date" VALUE=<?php echo $check_date ?>> <br>
      코로나 확진여부 : <INPUT TYPE = "text" NAME="COVID19_test_result" VALUE=<?php echo $COVID19_test_result ?>> <br>
      확진일    : <INPUT TYPE = "text" NAME="COVID19_diagnosis" VALUE=<?php echo $COVID19_diagnosis ?>> <br>
      입원일    : <INPUT TYPE = "text" NAME="hospitalization_date" VALUE=<?php echo $hospitalization_date ?>> <br>
      퇴원일    : <INPUT TYPE = "text" NAME="discharge_date" VALUE=<?php echo $discharge_date ?>> <br>
      사망일    : <INPUT TYPE = "text" NAME="death_date" VALUE=<?php echo $death_date ?>> <br>
      접종 여부 : <INPUT TYPE = "text" NAME="inoculation" VALUE=<?php echo $inoculation ?>> <br>
      접종 날짜 : <INPUT TYPE = "text" NAME="vaccination_date" VALUE=<?php echo $vaccination_date ?>> <br>
      접종한 백신 고유번호 : <INPUT TYPE = "text" NAME="vaccine_num" VALUE=<?php echo $vaccine_num ?>> <br>
      돌파감염여부 : <INPUT TYPE = "text" NAME="breakthrough_infection" VALUE=<?php echo $breakthrough_infection ?>> <br>
      <BR><BR>
      <INPUT TYPE="submit" VALUE="정보 수정">
</FORM>
</div>
</div>
</body>
</HTML>