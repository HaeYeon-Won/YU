<?php
$pID = $_POST["pID"];
echo "<!doctype html>\n";
echo "<html>\n";
echo "<head>\n";
echo "    \n";
echo "    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
echo "    <title>COVID-19</title>\n";
echo "    <style>\n";
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
echo "<a href=\"http://localhost/user.php\">\n";
echo "    <img src=\"https://www.kdca.go.kr/cdc/img/main/h1_logo.png\">\n";
echo "</a>\n";
echo "</div>\n";
echo "\n";
echo "<!---->\n";
echo "<table border=\"1\" bordercolor=\"white\" width =\"1200\" height=\"200\" align = \"center\" style=\"table-layout:fixed\">\n";
echo "    <tr bgcolor=\"#2A4970\" align =\"center\">\n";
echo "   <p>\n";
echo "        <td \n";
echo "            colspan = \"1\" span style=\"color:white\">\n";
//로그인 한 사람 이름 쿼리하는 부분
$db_host="localhost";
$db_user="root";
$db_password="1234";
$db_name="govdb";
$con=mysqli_connect($db_host, $db_user, $db_password, $db_name);
if(mysqli_connect_error($con))
{
    echo "접속실패", mysqli_connect_error();
    exit();
}

$sql ="select name from public_table WHERE public_table.pid='$pID'";
  
$ret = mysqli_query($con, $sql);
 
if($ret) 
{
    echo "<font size=7>"."<center>".mysqli_fetch_array($ret)[0],"님의 접종경과일 "."</center>";
}
else {
   echo "userTBL 데이터 조회 실패!!!"."<br>";
   echo "실패 원인 :".mysqli_error($con);
   exit();
}
   
mysqli_close($con);
echo "        </td>\n";
echo "    </p>\n";
echo "    </tr>\n";
echo "    <tr align = \"center\" bgcolor=\"C3D6F2\"width =\"400\" height=\"100\" >\n";
echo "    <td>\n";
//접종 경과일 쿼리
$db_host="localhost";
$db_user="root";
$db_password="1234";
$db_name="govdb";
$con=mysqli_connect($db_host, $db_user, $db_password, $db_name);
if(mysqli_connect_error($con))
{
    echo "접속실패", mysqli_connect_error();
    exit();
}
$sql ="select * from patient_table ,public_table WHERE public_table.pid='$pID' AND public_table.pid=patient_table.pid";
$ret = mysqli_query($con, $sql);
   if($ret) 
   {
    $row = mysqli_fetch_array($ret);
    if (is_null($row))
    {
        echo "<font size=6>"."<center>"."아직 접종하지 않았습니다! 빠른 시일내에 접종 부탁드립니다."."</center>";
    }
    else
    {
        $ino=$row[10];
        $vaccination_date=$row[11];
            if ($ino==0)
            {
                echo "<font size=6>"."<center>"."아직 접종하지 않았습니다! 빠른 시일내에 접종 부탁드립니다."."</center>";
            }
            else if($ino==1)
            {
    
                $start = new DateTime($vaccination_date); // 20120101 같은 포맷도 잘됨
                $now = new DateTime();
                $diff = date_diff($start, $now);
                echo "<font size=7>"."<center>"."1차 접종일로 부터 ", $diff->days, "일 경과했습니다."."</center>";
            }
            else if($ino==2)
            {
                $start = new DateTime($vaccination_date); // 20120101 같은 포맷도 잘됨
                $now = new DateTime();
                $diff = date_diff($start, $now);
                echo "<font size=7>"."<center>"."2차 접종일로 부터 ", $diff->days, "일 경과했습니다."."</center>";
            }
    }
   
    
   }
   else {
      echo "userTBL 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   
mysqli_close($con);
echo "    </td>\n";
echo "    </tr>\n";
echo "</table>\n";
echo "<!---->\n";
echo "<br><br><br>\n";
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
echo "    <tr align = \"center\" bgcolor=\"C3D6F2\"width =\"400\" height=\"100\" >\n";
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
SELECT * FROM patient_table WHERE COVID19_test_result='양성'
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
echo "</body>\n";
echo "</html>\n";
?>