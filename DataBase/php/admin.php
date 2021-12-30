<?php
echo "<!doctype html>\n";
echo "<html>\n";
echo "<head>\n";
echo "    \n";
echo "    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
echo "    <title>COVID-19/관리자페이지</title>\n";
echo "    <style>\n";
echo " a { color : black; text-decoration:none;}";
echo "        ul, ol, li { list-style:none; margin:0 auto; padding:0; float:right;}\n";
echo "        ul.myMenu {}\n";
echo "        ul.myMenu > li { display:inline-block; width:100px; padding:5px 10px; background:#eee; border:1px solid #eee; text-align:center; position:relative;}\n";
echo "        ul.myMenu > li:hover { background:#fff; }\n";
echo "        ul.myMenu > li ul.submenu { display:none; position:absolute; top:30px; left:0; }\n";
echo "        ul.myMenu > li:hover ul.submenu { display:block; }\n";
echo "        ul.myMenu > li ul.submenu > li { display:inline-block; width:100px; padding:5px 10px; background:#eee; border:1px solid #eee; text-align:center; }\n";
echo "        ul.myMenu > li ul.submenu > li:hover { background:#fff; }\n";
echo "    </style>\n";
echo "</head>\n";
echo "\n";
echo "<body bgcolor=\"#FFFFFF\">\n";
echo "<!--https://www.kdca.go.kr/cdc/img/main/h1_logo.png-->\n";
echo "\n";
echo "<div id=\"container\">\n";
echo "<a href=\"http://localhost/admin.php\">\n";
echo "    <img src=\"https://www.kdca.go.kr/cdc/img/main/h1_logo.png\">\n";
echo "</a>\n";
echo "    \n";
echo "<!--<font size=\"5.5\">정부</font>-->\n";
echo "<ul class=\"myMenu\">\n";
echo " <li class=\"menu6\"><a href=\"login.php\">로그아웃</a></li>\n";
echo "    <li class=\"menu5\"><a href=\"daegu.php\">대구병원</a></li>\n";
echo "    <li class=\"menu4\"><a href=\"knu.php\">경북대병원</a></li>\n";
echo "    <li class=\"menu3\"><a href=\"yu.php\">영남대병원</a></li>\n";
echo "    <li class=\"menu2\"><a href=\"moderna.php\">모더나</a></li>\n";
echo "    <li class=\"menu1\"><a href=\"Pfizer.php\">화이자</a></li>\n";
echo "       \n";
echo "</ul>\n";
echo "</div>\n";
echo "<br><br><br><br><br><br>\n";
echo "<table border=\"1\" bordercolor=\"white\" width =\"1200\" height=\"300\" align = \"center\" style=\"table-layout:fixed\">\n";
echo "    <tr bgcolor=\"#2A4970\" align =\"center\">\n";
echo "   <p><td colspan = \"5\" span style=\"color:white\">COVID-19 현황</td></p>\n";
echo "    </tr>\n";
echo "    <tr align = \"center\" width =\"400\" height=\"100\" bgcolor=\"#789CCE\" >\n";
echo "   <td>1차접종</td>\n";
echo "   <td>접종완료</td>\n";
echo "   <td>감염자현황</td>\n";
echo "   <td>돌파감염자</td>\n";
echo "   <td>사망자</td>\n";
echo "    </tr>\n";
echo "    <tr align = \"center\" width =\"400\" height=\"100\" bgcolor=\"C3D6F2\" >\n";
echo "    <td>\n";
//1차 접종자수 쿼리
$db_host="localhost";
$db_user="root";
$db_password="1234";
$db_name="";
$con=mysqli_connect($db_host, $db_user, $db_password, $db_name);
if(mysqli_connect_error($con))
{
    echo "접속실패", mysqli_connect_error();
    exit();
}
$sql="USE govdb";
$ret = mysqli_query($con, $sql);

if($ret) {
}
else {
    echo "USE 실패!!!"."<br>";
    echo "실패 원인 : ".mysqli_error($con);
    echo "<br>";
}
$sql ="
       SELECT * FROM patient_table WHERE inoculation = '1'
   ";//테이블 바꾸고 조건 1차접종 조건으로 바꿔줌
  
   $ret = mysqli_query($con, $sql);
 
   if($ret) 
   {
       
       echo "<font size=7>"."<center>".mysqli_num_rows($ret)."</center>";//여기해야함
        
   }
   else {
      echo "userTBL 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   
mysqli_close($con);
echo "    </td>\n";
echo "    \n";
echo "   <td>\n";
//2차 접종자수 쿼리
$db_host="localhost";
$db_user="root";
$db_password="1234";
$db_name="";
$con=mysqli_connect($db_host, $db_user, $db_password, $db_name);
if(mysqli_connect_error($con))
{
    echo "접속실패", mysqli_connect_error();
    exit();
}
$sql="USE govdb";
$ret = mysqli_query($con, $sql);

if($ret) {
}
else {
    echo "USE 실패!!!"."<br>";
    echo "실패 원인 : ".mysqli_error($con);
    echo "<br>";
}
$sql ="
SELECT * FROM patient_table WHERE inoculation = '2'
   ";//테이블 바꾸고 2차점종 조건으로 바꿔야함
  
   $ret = mysqli_query($con, $sql);
 
   if($ret) 
   {
    echo "<font size=7>"."<center>".mysqli_num_rows($ret)."</center>";
   }
   else {
      echo "userTBL 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   
mysqli_close($con);
echo "    </td>\n";
echo "    \n";
echo "   <td>\n";
//감염자현황
$db_host="localhost";
$db_user="root";
$db_password="1234";
$db_name="";
$con=mysqli_connect($db_host, $db_user, $db_password, $db_name);
if(mysqli_connect_error($con))
{
    echo "접속실패", mysqli_connect_error();
    exit();
}
$sql="USE govdb";
$ret = mysqli_query($con, $sql);

if($ret) {
}
else {
    echo "USE 실패!!!"."<br>";
    echo "실패 원인 : ".mysqli_error($con);
    echo "<br>";
}
$sql ="
SELECT * FROM patient_table WHERE COVID19_test_result='양성' and death_date = 0000-00-00
   ";//g환자 테이블에서 사망일이 null 인 행 구하면됌 

   $ret = mysqli_query($con, $sql);
 
   if($ret) 
   {
    echo "<font size=7>"."<center>".mysqli_num_rows($ret)."</center>";
   }
   else {
      echo "userTBL 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   
mysqli_close($con);
echo "    </td>\n";
echo "    \n";
echo "   <td>\n";
//돌파감염
$db_host="localhost";
$db_user="root";
$db_password="1234";
$db_name="";
$con=mysqli_connect($db_host, $db_user, $db_password, $db_name);
if(mysqli_connect_error($con))
{
    echo "접속실패", mysqli_connect_error();
    exit();
}
$sql="USE govdb";
$ret = mysqli_query($con, $sql);

if($ret) {
}
else {
    echo "USE 실패!!!"."<br>";
    echo "실패 원인 : ".mysqli_error($con);
    echo "<br>";
}
$sql ="
SELECT * FROM patient_table WHERE breakthrough_infection = 'Y'
   ";//2차를 접종이 된 환자 이고 사망일이  NULL
  
   $ret = mysqli_query($con, $sql);
 
   if($ret) 
   {
    echo "<font size=7>"."<center>".mysqli_num_rows($ret)."</center>";
   }
   else {
      echo "userTBL 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   
mysqli_close($con);
echo "    </td>\n";
echo "\n";
echo "   <td>\n";
//사망자
$db_host="localhost";
$db_user="root";
$db_password="1234";
$db_name="";
$con=mysqli_connect($db_host, $db_user, $db_password, $db_name);
if(mysqli_connect_error($con))
{
    echo "접속실패", mysqli_connect_error();
    exit();
}
$sql="USE govdb";
$ret = mysqli_query($con, $sql);

if($ret) {
}
else {
    echo "USE 실패!!!"."<br>";
    echo "실패 원인 : ".mysqli_error($con);
    echo "<br>";
}
$sql ="
SELECT * FROM patient_table WHERE death_date != 0000-00-00
   ";//사망일 에 null 이아니면됌
  
   $ret = mysqli_query($con, $sql);
 
   if($ret) 
   {
    echo "<font size=7>"."<center>".mysqli_num_rows($ret)."</center>";
   }
   else {
      echo "userTBL 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   
mysqli_close($con);
echo "    </td> \n";
echo "    \n";
echo "    </tr>\n";

echo "</table>\n";

echo "<BR><BR><BR><BR><BR>";
echo "<table border=\"1\" bordercolor=\"white\" width =\"1200\" height=\"400\" align = \"center\" style=\"table-layout:fixed\">\n";
echo "    <tr bgcolor=\"#2A4970\" align =\"center\">\n";
echo "   <p><td colspan = \"4\" span style=\"color:white\">병원별 백신 보유 현황</td></p>\n";
echo "    </tr>\n";
echo "    <tr align = \"center\" width =\"400\" height=\"100\" bgcolor=\"#789CCE\" >\n";
echo "   <td></td>\n";
echo "   <td>영남대병원</td>\n";
echo "   <td>대구병원</td>\n";
echo "   <td>경북대병원</td>\n";
echo "    </tr>\n";

//화이자
echo "    <tr align = \"center\" width =\"400\" height=\"100\" bgcolor=\"C3D6F2\" >\n";
echo "<td>\n";
echo "화이자";
echo  "</td>\n";
//영남대
$con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
$sql ="SELECT count(*) FROM vaccine_table WHERE sysdate() < (expiration_date) AND own_name = '영남대병원' AND vaccine_table.use = 'n' AND vaccine_table.company_name='화이자'";
 
   $ret = mysqli_query($con, $sql);   
   if($ret) 
   {
    while($row=mysqli_fetch_array($ret))
    {
        echo "<td>\n";
        echo "<font size=7>"."<center>".$row[0]."</center>";
        echo  "</td>\n";
    } 
   }
   else
   {
      echo "vaccine_table 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   } 
   mysqli_close($con);
//

//대구
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   $sql ="SELECT count(*) FROM vaccine_table WHERE sysdate() < (expiration_date) AND own_name = '대구병원' AND vaccine_table.use = 'n' AND vaccine_table.company_name='화이자'";
 
   $ret = mysqli_query($con, $sql);   
   if($ret) 
   {
    while($row=mysqli_fetch_array($ret))
    {
        echo "<td>\n";
        echo "<font size=7>"."<center>".$row[0]."</center>";
        echo  "</td>\n";
    } 
   }
   else
   {
      echo "vaccine_table 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   } 
   mysqli_close($con);
//

//경북대
$con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
$sql ="SELECT count(*) FROM vaccine_table WHERE sysdate() < (expiration_date) AND own_name = '경북대병원' AND vaccine_table.use = 'n' AND vaccine_table.company_name='화이자'";

$ret = mysqli_query($con, $sql);   
if($ret) 
{
 while($row=mysqli_fetch_array($ret))
 {
    echo "<td>\n";
    echo "<font size=7>"."<center>".$row[0]."</center>";
    echo  "</td>\n";
 } 
}
else
{
   echo "vaccine_table 데이터 조회 실패!!!"."<br>";
   echo "실패 원인 :".mysqli_error($con);
   exit();
} 
mysqli_close($con);
//
echo "    </tr>\n";

//모더나
echo "    <tr align = \"center\" width =\"400\" height=\"100\" bgcolor=\"C3D6F2\" >\n";
echo "<td>\n";
echo "모더나";
echo  "</td>\n";
//영남대
$con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
$sql ="SELECT count(*) FROM vaccine_table WHERE sysdate() < (expiration_date) AND own_name = '영남대병원' AND vaccine_table.use = 'n' AND vaccine_table.company_name='모더나'";
 
   $ret = mysqli_query($con, $sql);   
   if($ret) 
   {
    while($row=mysqli_fetch_array($ret))
    {
        echo "<td>\n";
        echo "<font size=7>"."<center>".$row[0]."</center>";
        echo  "</td>\n";
    } 
   }
   else
   {
      echo "vaccine_table 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   } 
   mysqli_close($con);
//

//대구
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   $sql ="SELECT count(*) FROM vaccine_table WHERE sysdate() < (expiration_date) AND own_name = '대구병원' AND vaccine_table.use = 'n' AND vaccine_table.company_name='모더나'";
 
   $ret = mysqli_query($con, $sql);   
   if($ret) 
   {
    while($row=mysqli_fetch_array($ret))
    {
        echo "<td>\n";
        echo "<font size=7>"."<center>".$row[0]."</center>";
        echo  "</td>\n";
    } 
   }
   else
   {
      echo "vaccine_table 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   } 
   mysqli_close($con);
//

//경북대
$con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
$sql ="SELECT count(*) FROM vaccine_table WHERE sysdate() < (expiration_date) AND own_name = '경북대병원' AND vaccine_table.use = 'n' AND vaccine_table.company_name='모더나'";

$ret = mysqli_query($con, $sql);   
if($ret) 
{
 while($row=mysqli_fetch_array($ret))
 {
    echo "<td>\n";
    echo "<font size=7>"."<center>".$row[0]."</center>";
    echo  "</td>\n";
 } 
}
else
{
   echo "vaccine_table 데이터 조회 실패!!!"."<br>";
   echo "실패 원인 :".mysqli_error($con);
   exit();
} 
mysqli_close($con);
echo "    </tr>\n";


echo "</table>\n";
echo "</body>\n";
echo "</html>\n";
?>
<HTML>
<HEAD>
<META http-equiv="content-type" content="text/html; charset=utf-8">
</HEAD>
<BODY>
<style>
#pur { position : absolute; top : 89%; left : 76% }
</style>
<div id = "pur">
<button  type='button' onclick="location.href='purchase.php'">백신 발주</button >
</div>
</BODY>
</HTML>