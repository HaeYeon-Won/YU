<HTML>
<Head>
<META http-equiv="content-type" content="text/html; charset=utf-8">
<title>경북대학교병원</title>
</Head>
<body>
<style>
em {text-align:center; font-style : normal; font-size : 13px; display:inline-block;}
img {display : inline-block; position: fixed; top:27px; left:20px}
h2{display : inline-block}
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
<h2>  환자 정보 관리 </h2>
<div class = "st">
 <strong> - 환자 정보 조회 </strong>
</div>
</div>
<div class = "s">
<button  type='button' onclick="location.href='물품관리_경북대.php'">물품관리</button >
<button  type='button' onclick="location.href='insert_K.php'">새로운 환자 추가</button >
<button  type='button' onclick="location.href='knu.php'">main화면</button >
</div>
<div id = "form">
<?php
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   $sql ="SELECT * FROM patient_table WHERE pid = '".$_GET['pid']."' AND patient_table.hospital_name='경북대병원'";

   $ret = mysqli_query($con, $sql);   
   if($ret){
     $count = mysqli_num_rows($ret);
     if($count==0){
        echo $_GET['pid']." 해당하는 환자가 없음!!"."<br>";
        echo "<br> <a href='knu.php'> <--초기 화면</a> ";
        exit();
     }
  }
  else{
     echo "데이터 조회 실패!"."<br>";
     echo "실패 원인: ".mysqli_error($con);
     echo "<br> <a href ='knu.php'> <--메인화면</a>";
     exit();
  }
  
   $row = mysqli_fetch_array($ret);
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

<FORM METHOD="post" ACTION="update_result_K.php">
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