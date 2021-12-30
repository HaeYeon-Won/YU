
<!doctype html>
<HTML>
<Head>
<META http-equiv="content-type" content="text/html; charset=utf-8">
<title>경북대학교병원</title>
</Head>
<body>
<style>
em {text-align:center; font-style : normal; font-size : 13px; display:inline-block;}
img {display : inline-block; position: fixed; top:27px; left:20px}
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
		display:absolute; width:70%; height:100%; border : 2.5px solid #d80c18; border-radius:10px;}
.form_text{ position:relative; top:38%; left:10%}
.sss {display : inline-block; color:#333; position : absolute; left : 70% ; }
 .s {display : inline-block; color:#333; position : absolute; left : 75% ; top : 15%}
  .t { display : inline-block; position : absolute; left:50%}
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
<div class = "t">
<?php
// 화이자
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   $sql="USE govdb";
   $sql = "SELECT vaccine_table.vaccine_own_num, vaccine_table.production_date, vaccine_table.expiration_date, vaccine_table.company_name, vaccine_table.use FROM vaccine_table WHERE own_name ='경북대병원' AND company_name='화이자'";
 
   $ret = mysqli_query($con, $sql);   
   if($ret) 
   {
      //echo mysqli_num_rows($ret), "건이 조회됨..<br><br>";
      $count = mysqli_num_rows($ret);
   }
   else 
   {
      echo "vaccine_table 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   } 

   echo "<TABLE border=1>";
   echo "<TR>";
   echo "<TH>백신고유번호</TH><TH>생산날짜</TH><TH>폐기날짜</TH><TH>제약사이름</TH><TH>사용여부</TH>";
   echo "</TR>";
   
	while($row=mysqli_fetch_array($ret))
	{
	echo "<TR>";
	echo "<TD>", $row['vaccine_own_num'], "</TD>";
	echo "<TD>", $row['production_date'], "</TD>";
	echo "<TD>", $row['expiration_date'], "</TD>";
	echo "<TD>", $row['company_name'], "</TD>";
	echo "<TD>", $row['use'], "</TD>";
	echo "</TR>";
	} 
   mysqli_close($con);
   echo "</TABLE>"; 
   echo "<br>";
   echo "<br>";
    $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   // 재고량
   $sql ="SELECT count(*) FROM vaccine_table WHERE sysdate() < (expiration_date) AND own_name = '경북대병원' AND vaccine_table.use = 'n' ";
 
   $ret = mysqli_query($con, $sql);   
   if($ret) 
   {
      //echo mysqli_num_rows($ret), "건이 조회됨..<br><br>";
      $count = mysqli_num_rows($ret);
   }
   else
   {
      echo "vaccine_table 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   } 
	// 현재 재고량 출력 부분
   echo "현재 재고량은 "; 
   while($row=mysqli_fetch_array($ret))
   {
		echo $row[0], "입니다.", "<br>", "<br>";
   } 
   mysqli_close($con);
   
   // 누적 폐기량 출력 부분
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
	  
   $sql ="SELECT count(*) FROM vaccine_table WHERE sysdate() >= (expiration_date) AND own_name = '경북대병원' AND vaccine_table.use = 'n' ";
   $ret = mysqli_query($con, $sql); 
   echo "누적 폐기량은 ";
   while($row=mysqli_fetch_array($ret))
   {
		echo $row[0], "입니다.", "<br>", "<br>";
   } 
   mysqli_close($con);
?>

</div>
<?php
// 모더나
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   $sql="USE govdb";
   $sql = "SELECT vaccine_table.vaccine_own_num, vaccine_table.production_date, vaccine_table.expiration_date, vaccine_table.company_name, vaccine_table.use FROM vaccine_table WHERE own_name ='경북대병원' AND company_name='모더나'";
 
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
   echo "<TH>백신고유번호</TH><TH>생산날짜</TH><TH>폐기날짜</TH><TH>제약사이름</TH><TH>사용여부</TH>";
   echo "</TR>";
   
	while($row=mysqli_fetch_array($ret))
	{
	echo "<TR>";
	echo "<TD>", $row['vaccine_own_num'], "</TD>";
	echo "<TD>", $row['production_date'], "</TD>";
	echo "<TD>", $row['expiration_date'], "</TD>";
	echo "<TD>", $row['company_name'], "</TD>";
	echo "<TD>", $row['use'], "</TD>";
	echo "</TR>";
	} 
   mysqli_close($con);
   echo "</TABLE>"; 
 ?>
</div>
</div>
</body>
</HTML>




