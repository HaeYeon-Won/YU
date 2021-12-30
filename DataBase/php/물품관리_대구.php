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
 .m{position: absolute; top:23%; left : 26%; text-align :center;
      display : inline-block; width:60%; height: 2300px ; border : 2.5px solid #1d2975; border-radius:10px;}
  .m_text{ position:absolute; top:38%; right:2.8%}
 a{display : block; padding-top : 9%; padding-right : 2.5%}
  .t{ display : inline-block; position : absolute; left:50%; height : auto }

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
<a href="select_D.php" > ▶ 환자정보조회 </a>
<a href="전체환자조회_대구.php" > ▶ 전체환자정보조회 </a>
<a href="insert_D.php" > ▶ 신규환자등록 </a> 
<a href="update_D.php" > ▶ 환자정보수정 </a>
<a href="delete_D.php" > ▶ 환자정보삭제 </a>
<a href="물품관리_대구.php" style="color:blue"> ▶ 물품관리 </a>
</div>
<div class ="m">
<div class = "t">
<?php
// 화이자
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   $sql="USE govdb";
   $sql = "SELECT vaccine_table.vaccine_own_num, vaccine_table.production_date, vaccine_table.expiration_date, vaccine_table.company_name, vaccine_table.use FROM vaccine_table WHERE own_name ='대구병원' AND company_name='화이자'";
 
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
   $sql ="SELECT count(*) FROM vaccine_table WHERE sysdate() < (expiration_date) AND own_name = '대구병원' AND vaccine_table.use = 'n' ";
 
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
     
   $sql ="SELECT count(*) FROM vaccine_table WHERE sysdate() >= (expiration_date) AND own_name = '대구병원' AND vaccine_table.use = 'n' ";
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
   $sql = "SELECT vaccine_table.vaccine_own_num, vaccine_table.production_date, vaccine_table.expiration_date, vaccine_table.company_name, vaccine_table.use FROM vaccine_table WHERE own_name ='대구병원' AND company_name='모더나'";
 
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