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
.st {display : inline-block; color:#333}
.name { display : inline-block; position: absolute; top:5px; right:90px}
.logout {width: 60px; height:20px; background:#0d4199;
		display : inline-block; border-radius : 8px; color:white; float:right;
		position:absolute; top : 27px; right : 21px; font-size:13px; text-align:center}
 #content{position:absolute; top:12%; left:15%; display : inline-block}
 #form{position: absolute; top:20%; left : 15%; text-align :center;
		display:absolute; width:75%; height:auto; border : 2.5px solid #0d4199; border-radius:10px;}
 .form_text{ position:relative; top:38%; right:2.8%; }
 
  #form2{
      display:absolute; width:50%; height:50%;  border-radius:10px;}
 .st { display : inline-block }
 .t { display : inline-block; position : absolute; left:50%}
  #sub{position: fixed; top:20%; left : 2%; text-align :center; background : #0d4199;
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
<h2> | 물품관리 </h2>
<div class = "st">
 <strong> - 백신정보관리 </strong>
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
<div class = "t">
<?php
// 화이자
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   $sql="USE govdb";
   $sql = "SELECT vaccine_table.vaccine_own_num, vaccine_table.production_date, vaccine_table.expiration_date, vaccine_table.company_name, vaccine_table.use FROM vaccine_table WHERE own_name ='영남대병원' AND company_name='화이자'";
 
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
   $sql ="SELECT count(*) FROM vaccine_table WHERE sysdate() < (expiration_date) AND own_name = '영남대병원' AND vaccine_table.use = 'n' ";
 
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
	  
   $sql ="SELECT count(*) FROM vaccine_table WHERE sysdate() >= (expiration_date) AND own_name = '영남대병원' AND vaccine_table.use = 'n' ";
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
   $sql = "SELECT vaccine_table.vaccine_own_num, vaccine_table.production_date, vaccine_table.expiration_date, vaccine_table.company_name, vaccine_table.use FROM vaccine_table WHERE own_name ='영남대병원'AND company_name='모더나'";
 
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

</FORM>
</div>
</div>
</FORM>
</div>
</body>
</HTML>