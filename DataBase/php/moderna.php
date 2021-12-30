<HTML>
    <Head>
    <META http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Moderna</title>
    </Head>
    <body>
    <style>
    * {margin: 0; padding: 0;}
    a {color:black; text-decoration : none}
    em {text-align:center; font-style : normal; font-size : 13px; display:inline-block;}
    img {display : inline-block; position: fixed; top:27px; left:20px;}
    h3{color : black}
    h5{ display : inline-block; }
    h5 { color : black }
    index {display : inline-block; position : absolute; top:50px; left:45px}
    .menu { position : absolute; height : 10% }
    .main { position : absolute; height : 70% }
    #header{width:100%; height:60px; display : block; position: absolute; }
    .st {display : inline-block; color:#333}
    .name { display : inline-block; position: absolute; top:50%; right:90px}
    .logout {display : inline-block; width: 60px; height:20px; background:#ff8686;
          display : inline-block; border-radius : 8px; color:white; float:right;
          position:absolute; top : 27px; right : 21px; font-size:13px; text-align:center}
    #php { display : inline-block; color:black; position: absolute; top: 17%; left : 35%}
	.b { display : inline-block; position : absolute; top : 25%; left : 5%; width : 50%; height : auto}
	.c { color:black; position: absolute; top: 20%; left : 2% }
    </style>
    <div id = "header">
    <img src="https://www.modernatx.com/sites/all/themes/moderna/images/moderna-logo.png" width = 250, height = auto>
    <div class = "name">
    <h5>Emma Watson</h5>
    </div>
    <div class= "logout">
    <button  type='button' onclick="location.href='admin.php'">logout</button >
    </div>
    </div>
    <div class="menu">
    </div>
    <div class="main">
    </div>
    
    <style>
        #tab_content {position: absolute; top: 15%; border: solid 1px #ff9999; width: 90%; height: 80%; left: 5%; background:#fff6f7; border-top-left-radius: 10px;border-top-right-radius: 10px;}
        input[type="radio"] {display: none;}
        input[type="radio"] + label { display: inline-block; background-color: #ff9999; color: #333; top:6%;
        font-size: 1.2rem; cursor: pointer;width : 20%; height:10%; text-align: center; position: relative; left: 10%;border-top-left-radius: 10px;border-top-right-radius: 10px;}
        input[type="radio"]:checked + label { background: rgb(179, 179, 179); color: #fff; position: relative; border-top-left-radius: 10px;border-top-right-radius: 10px;}
        .conbox { width: 87%; height: 67%; background : #fff;  color:#ff9999;  position: absolute; top : 5%; left: 3.5%;  display: none; padding: 3%;border-top-left-radius: 10px;border-top-right-radius: 10px;}
        .conbox_text{color : black;}
        input[id = "tab01"]:checked ~ .con1 {display: block; position: absolute; top: 16%; }
        input[id = "tab02"]:checked ~ .con2 {display: block; position: absolute; top: 16%}
        input[id = "tab03"]:checked ~ .con3 {display: block; position: absolute; top: 16%}
		input[id = "tab04"]:checked ~ .con4 {display: block; position: absolute; top: 16%}
    .txt { position: absolute; top: 28%; left: 33%;}
    .txt1 { position: absolute; top:28%; left: 33%}
    .txt2 { position: absolute; top:28%; left: 28%}
	.txt3 { position: absolute; top:28%; left: 42%}
	#php1 { display : inline-block; color:black; position: absolute; top: 5%; left : 18%}
	
</style>
<div id="tab_content">
<input type="radio" name = "tabmenu" id = "tab01" checked>
<label for = "tab01"><div class="txt1"> 과거생산량 </div></label>
<input type="radio" name = "tabmenu" id = "tab02">
<label for = "tab02"><div class="txt"> 생산계획량 </div></label>
<input type="radio" name = "tabmenu" id = "tab03">
<label for = "tab03"><div class="txt2"> 재고량, 폐기량 </div></label>
<input type="radio" name = "tabmenu" id = "tab04">
<label for = "tab04"><div class="txt3"> 제공 </div></label>


<div class="conbox con1">
<div id="php">

<?php
// 과거생산량 그래프
// 다른 파일의 사용자 정의 함수 "makeChartParts ()"를 읽어들입니다.

require_once './make_chart_parts.php';

$con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");

$sql ="SELECT purchase_table.amount, MONTH(purchase_table.order_date) FROM purchase_table WHERE purchase_table.trade_type='S' AND purchase_table.supply_institution='모더나'";
$ret = mysqli_query($con, $sql);   
   
if($ret) 
{
   $count = mysqli_num_rows($ret);
}
else
{
   echo "select error!"."<br>";
   echo "실패 원인 :".mysqli_error($con);
   exit();
} 

$data = array(array("", "생산량"),

  array('1월',   0), array('2월',   0), array('3월',   0),

  array('4월',  0), array('5월',  0), array('6월',  0),

  array('7월',  0), array('8월',  0), array('9월',  0),

  array('10월', 0), array('11월', 0), array('12월',  0));
  while($row = mysqli_fetch_array($ret)) 
  {
     
     //0:거래종류 1:수량 2:거래월
     //echo gettype((int)$row[1]), "<BR>";
     //echo gettype($row[0]), "<BR>";
     //echo $row[0], "<BR>";
     //echo gettype($row[1]), "<BR>";
     //echo $row[1], "<BR>";
      $data[(int)$row[1]][1]+=(int)$row[0];
      //echo $data[9][0];
      //echo $data[9][1];
  }

// 그래프 옵션

$options = array(

  'title'  => '과거생산량',  // 그래프 제목

  'titleTextStyle' => array('fontSize' => 16), // 제목 스타일

  'series' => array(1 => array('targetAxisIndex' => 1)),  // 세로축을 2 축화

  'vAxes'  => array(0 => array('title'    => '왼쪽제목',  // 세로축 왼쪽

                               'minValue' =>  0, 'minValue' => 40),

                    1 => array('title'    => '오른쪽제목',  // 세로축 오른쪽

                               'minValue' => 40, 'maxValue' => 80)),

  'width'  => 790, 'height' => 350,  // 폭, 높이

  'chartArea' => array('width' => 800, 'height' => 300),  // 차트 영역

  'legend' => array('position' => 'in', 'alignment' => 'start'));  // 범례



// 그래프 유형 (막대 그래프)

$type = 'ColumnChart';



// 그래프 그림의 JavaScript 함수, 표시할 <div> 태그의 생성

list($chart, $chart_div) = makeChartParts($data, $options, $type);



// // 두 번째 그래프는 첫 번째 그래프의 데이터를 테이블로 하기

// $options = array('width' => 500);  // 그래프 (테이블 세트) 옵션

// $type = 'Table';  // 그래프 유형 (테이블 세트)

// list($table, $table_div) = makeChartParts($data, $options, $type);

?>

<html lang="ko">

<head>

<meta charset="UTF-8">

<title>막대 그래프를 생성하고 싶을 때</title>

<script src="https://www.google.com/jsapi"></script>

<script>

<?php

// 그래프 그리기 함수를 표시합니다.

echo $chart;

?>

</script>
</head>
<body>
<div>
<?php
// 차트를 표시 할 <div> 태그를 적당한 위치에 배치합니다.
echo $chart_div;
?>
</div>
</div>

<div class = "b">
<?php
// 상반기 출력
   echo "<table border=\"3\" bordercolor=\"#ff9999\" width =\"50%\" height=\"auto\" align = \"center\" style=\"table-layout:fixed\">\n";
   echo "    </tr>\n";
   echo "    <tr align = \"center\" width =\"300\" height=\"100\" >\n";
   echo "   <td>상반기</td>\n";
   echo "   <td>하반기</td>\n";
   echo "    </tr>\n";
   echo "    <tr align = \"center\" width =\"300\" height=\"100\" >\n";
   echo "    <td>\n";

   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   if(mysqli_connect_error($con))
{
    echo "접속실패", mysqli_connect_error();
    exit();
}
$sql="USE govdb";
$ret = mysqli_query($con, $sql);

if($ret) 
{
}
else
	{
    echo "USE 실패!!!"."<br>";
    echo "실패 원인 : ".mysqli_error($con);
    echo "<br>";
}
   $sql ="SELECT sum(purchase_table.amount) FROM purchase_table WHERE supply_institution='모더나' AND (MONTH(purchase_table.order_date) IN ('01', '02', '03', '04', '05', '06')) AND purchase_table.trade_type = 's'"; 

  
   $ret = mysqli_query($con, $sql);
   $row = mysqli_fetch_array($ret);
   
   if($ret) 
   {
    echo "<font size=7>"."<center>".$row[0]."</center>";
   }
   else {
      echo "govdb 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   
mysqli_close($con);
echo "    </td>\n";
echo "    \n";
echo "   <td>\n";

// 하반기 구현
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
if(mysqli_connect_error($con))
{
    echo "접속실패", mysqli_connect_error();
    exit();
}
$sql="USE govdb";

if($ret) {
}
else {
    echo "USE 실패!!!"."<br>";
    echo "실패 원인 : ".mysqli_error($con);
    echo "<br>";
}
   $sql ="SELECT sum(purchase_table.amount) FROM purchase_table WHERE supply_institution='모더나' AND (MONTH(purchase_table.order_date) IN ('07', '08', '09', '10', '11', '12')) AND purchase_table.trade_type = 's'"; 

  
   $ret = mysqli_query($con, $sql);
   $row = mysqli_fetch_array($ret);
   
   if($ret) 
   {
    echo "<font size=7>"."<center>". $row[0]."</center>";
   }
   else 
   {
      echo "puchase_table 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   
mysqli_close($con);
echo "    </td>\n";
echo "\n";
echo "</table>";

?>
</div>
</div>

<div class="conbox con2">
<div id="php1">
<?php

// 다른 파일의 사용자 정의 함수 "makeChartParts ()"를 읽어들입니다.

require_once './make_chart_parts.php';

$con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");

$sql ="SELECT purchase_table.amount, MONTH(purchase_table.order_date) FROM purchase_table WHERE purchase_table.trade_type='b' AND purchase_table.supply_institution='모더나'";
$ret = mysqli_query($con, $sql);   
   
if($ret) 
{
   $count = mysqli_num_rows($ret);
}
else
{
   echo "select error!"."<br>";
   echo "실패 원인 :".mysqli_error($con);
   exit();
} 

$data = array(array("", "생산량"),

  array('1월',   0), array('2월',   0), array('3월',   0),

  array('4월',  0), array('5월',  0), array('6월',  0),

  array('7월',  0), array('8월',  0), array('9월',  0),

  array('10월', 0), array('11월', 0), array('12월',  0));
  while($row = mysqli_fetch_array($ret)) 
  {
     
     //0:거래종류 1:수량 2:거래월
     //echo gettype((int)$row[1]), "<BR>";
     //echo gettype($row[0]), "<BR>";
     //echo $row[0], "<BR>";
     //echo gettype($row[1]), "<BR>";
     //echo $row[1], "<BR>";
      $data[(int)$row[1]][1]+=(int)((int)$row[0]*1.1);
      //echo $data[9][0];
      //echo $data[9][1];
  }

// 그래프 옵션

$options = array(

  'title'  => '현재 생산 예정',  // 그래프 제목

  'titleTextStyle' => array('fontSize' => 16), // 제목 스타일

  'series' => array(1 => array('targetAxisIndex' => 1)),  // 세로축을 2 축화

  'vAxes'  => array(0 => array('title'    => '왼쪽제목',  // 세로축 왼쪽

                               'minValue' =>  0, 'minValue' => 40),

                    1 => array('title'    => '오른쪽제목',  // 세로축 오른쪽

                               'minValue' => 40, 'maxValue' => 80)),

  'width'  => 800, 'height' => 350,  // 폭, 높이

  'chartArea' => array('width' => 800, 'height' => 300),  // 차트 영역

  'legend' => array('position' => 'in', 'alignment' => 'start'));  // 범례

// 그래프 유형 (선 그래프)

$type = 'LineChart';



// 그래프 그림의 JavaScript 함수, 표시할 <div> 태그의 생성

list($chart, $chart_div) = makeChartParts($data, $options, $type);



// 두 번째 그래프는 첫 번째 그래프의 데이터를 테이블로 하기

$options = array('width' => 240);  // 그래프 (테이블 세트) 옵션

$type = 'Table';  // 그래프 유형 (테이블 세트)

list($table, $table_div) = makeChartParts($data, $options, $type);

?>

<html lang="ko">

<head>

<meta charset="UTF-8">


<script src="https://www.google.com/jsapi"></script>

<script>

<?php

// 그래프 그리기 함수를 표시합니다.

echo "        ", $chart;

?>

</script>
</head>
<body>
<div>
<?php
// 차트를 표시 할 <div> 태그를 적당한 위치에 배치합니다.
echo $chart_div;
?>
</div>
</div>
<div class = "c">
<?php
// 1월
echo "<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>";
   echo "<table border=\"3\" bordercolor=\"#ff9999\" width =\"98%\" height=\"25%\" align = \"center\" style=\"table-layout:fixed\" word-break:break-all\">\n";
   echo "    </tr>\n";
   echo "   <tr align = \"center\" width =\"98%\" height=\"25%\" >\n";
   echo "   <td>1월</td>\n";
   echo "   <td>2월</td>\n";
   echo "   <td>3월</td>\n";
   echo "   <td>4월</td>\n";
   echo "   <td>5월</td>\n";
   echo "   <td>6월</td>\n";
   echo "   <td>7월</td>\n";   
   echo "   <td>8월</td>\n";   
   echo "   <td>9월</td>\n";   
   echo "   <td>10월</td>\n";   
   echo "   <td>11월</td>\n";
   echo "   <td>12월</td>\n";          
   echo "    </tr>\n";
   
   echo "    <tr align = \"center\" width =\"98%\" height=\"25%\" >\n";
   
echo "    <td>\n";

$con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
if(mysqli_connect_error($con))
{
    echo "접속실패", mysqli_connect_error();
    exit();
}
$sql="USE govdb";
$ret = mysqli_query($con, $sql);

if($ret) 
{
}
else {
    echo "USE 실패!!!"."<br>";
    echo "실패 원인 : ".mysqli_error($con);
    echo "<br>";
}
   $sql ="SELECT MONTH(purchase_table.order_date), purchase_table.amount FROM purchase_table WHERE trade_type = 'b' AND purchase_table.supply_institution='모더나' "; 
   $ret = mysqli_query($con, $sql);
   
   $row=mysqli_fetch_array($ret);
   if($ret) 
   {
      $data = array(array("", ""),

  array('1월',   0), array('2월',   0), array('3월',   0),

  array('4월',  0), array('5월',  0), array('6월',  0),

  array('7월',  0), array('8월',  0), array('9월',  0),

  array('10월', 0), array('11월', 0), array('12월',  0));

      while($row=mysqli_fetch_array($ret))
      {
         $data[(int)$row[0]][1]+=(int)((int)$row[1]*1.1);
      }
  
   }
   else 
   {
      echo "userTBL 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   echo "<font size=7>"."<center>".$data[1][1]."</center>";
mysqli_close($con);
echo "    </td>\n";
echo "    \n";

echo "    <td>\n";
echo "<font size=7>"."<center>".$data[2][1]."</center>";
echo "    </td>\n";
echo "    \n";

echo "    <td>\n";
echo "<font size=7>"."<center>".$data[3][1]."</center>";
echo "    </td>\n";
echo "    \n";

echo "    <td>\n";
echo "<font size=7>"."<center>".$data[4][1]."</center>";
echo "    </td>\n";
echo "    \n";

echo "    <td>\n";
echo "<font size=7>"."<center>".$data[5][1]."</center>";
echo "    </td>\n";
echo "    \n";

echo "    <td>\n";
echo "<font size=7>"."<center>".$data[6][1]."</center>";
echo "    </td>\n";
echo "    \n";

echo "    <td>\n";
echo "<font size=7>"."<center>".$data[7][1]."</center>";
echo "    </td>\n";
echo "    \n";

echo "    <td>\n";
echo "<font size=7>"."<center>".$data[8][1]."</center>";
echo "    </td>\n";
echo "    \n";

echo "    <td>\n";
echo "<font size=7>"."<center>".$data[9][1]."</center>";
echo "    </td>\n";
echo "    \n";

echo "    <td>\n";
echo "<font size=7>"."<center>".$data[10][1]."</center>";
echo "    </td>\n";
echo "    \n";

echo "    <td>\n";
echo "<font size=7>"."<center>".$data[11][1]."</center>";
echo "    </td>\n";
echo "    \n";

echo "    <td>\n";
echo "<font size=7>"."<center>".$data[12][1]."</center>";
echo "    </td>\n";
echo "    \n";
echo "\n";
echo "</table>";
?>
</body>
</html>
</div>
</div>

<div class="conbox con3">
<div id="php">
<?php
// 다른 파일의 사용자 정의 함수 "makeChartParts ()"를 읽어들입니다.

require_once './make_chart_parts.php';

$con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");

$sql ="SELECT MONTH(vaccine_table.expiration_date), vaccine_table.vaccine_own_num FROM vaccine_table WHERE vaccine_table.company_name='모더나' AND CURDATE() >= vaccine_table.expiration_date AND vaccine_table.use='n'";
$ret = mysqli_query($con, $sql);   
   
if($ret) 
{
   $data = array(array("", "폐기량"),

  array('1월',   0), array('2월',   0), array('3월',   0),

  array('4월',  0), array('5월',  0), array('6월',  0),

  array('7월',  0), array('8월',  0), array('9월',  0),

  array('10월', 0), array('11월', 0), array('12월',  0));
  while($row = mysqli_fetch_array($ret)) 
  {
     $data[(int)$row[0]][1]+=1;
  }
  
}
else
{
   echo "select error!"."<br>";
   echo "실패 원인 :".mysqli_error($con);
   exit();
} 


// 그래프 옵션

$options = array(

  'title'  => '누적 폐기량',  // 그래프 제목

  'titleTextStyle' => array('fontSize' => 16), // 제목 스타일

  'series' => array(1 => array('targetAxisIndex' => 1)),  // 세로축을 2 축화

  'vAxes'  => array(0 => array('title'    => '왼쪽제목',  // 세로축 왼쪽

                               'minValue' =>  0, 'minValue' => 40),

                    1 => array('title'    => '오른쪽제목',  // 세로축 오른쪽

                               'minValue' => 40, 'maxValue' => 80)),

  'width'  => 800, 'height' => 350,  // 폭, 높이

  'chartArea' => array('width' => 800, 'height' => 300),  // 차트 영역

  'legend' => array('position' => 'in', 'alignment' => 'start'));  // 범례



// 그래프 유형 (막대 그래프)

$type = 'ColumnChart';



// 그래프 그림의 JavaScript 함수, 표시할 <div> 태그의 생성

list($chart, $chart_div) = makeChartParts($data, $options, $type);



// // 두 번째 그래프는 첫 번째 그래프의 데이터를 테이블로 하기

// $options = array('width' => 500);  // 그래프 (테이블 세트) 옵션

// $type = 'Table';  // 그래프 유형 (테이블 세트)

// list($table, $table_div) = makeChartParts($data, $options, $type);

?>

<html lang="ko">

<head>

<meta charset="UTF-8">

<title>막대 그래프를 생성하고 싶을 때</title>

<script src="https://www.google.com/jsapi"></script>

<script>

<?php

// 그래프 그리기 함수를 표시합니다.

echo $chart;

?>

</script>
</head>
<body>
<div>
<?php
// 차트를 표시 할 <div> 태그를 적당한 위치에 배치합니다.
echo $chart_div;
?>
</div>
</div>

<div class = "b">
<?php
// 상반기 구현
   echo "<table border=\"3\" bordercolor=\"#ff9999\" width =\"50%\" height=\"auto\" align = \"center\" style=\"table-layout:fixed\">\n";
   echo "    </tr>\n";
   echo "    <tr align = \"center\" width =\"300\" height=\"100\" >\n";
   echo "   <td>재고량</td>\n";
   echo "    </tr>\n";
   echo "    <tr align = \"center\" width =\"300\" height=\"100\" >\n";
   echo "    <td>\n";

   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
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
$sql ="SELECT vaccine_inventory FROM company_table WHERE company_name = '모더나'";

  
   $ret = mysqli_query($con, $sql);
   $row = mysqli_fetch_array($ret);
   
   if($ret) 
   {
      if (is_null($row[0]))
      {
         echo "<font size=7>"."<center>".'0'."</center>";
      }
      else
      {
         echo "<font size=7>"."<center>".$row[0]."</center>";
      }
   }
   else {
      echo "govdb 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   
mysqli_close($con);
echo "    </td>\n";
echo "    \n";
echo "</table>";

?>

</div>
</div>
<div class = "conbox con4">
<div id ="php">
<?php
// 상반기 구현
echo "<table border=\"3\" bordercolor=\"#ff9999\" width =\"50%\" height=\"auto\" align = \"center\" style=\"table-layout:fixed\">\n";
echo "    </tr>\n";
echo     "<font size=7>"."<caption>"."병원별 요청현황"."</caption>";
echo "    <tr align = \"center\" width =\"300\" height=\"100\" >\n";
echo "   <td>영남대병원</td>\n";
echo "   <td>경북대병원</td>\n";
echo "   <td>대구병원</td>\n";
echo "    </tr>\n";
echo "    <tr align = \"center\" width =\"300\" height=\"100\" >\n";
$con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   if(mysqli_connect_error($con))
{
    echo "접속실패", mysqli_connect_error();
    exit();
}
echo "    <td>\n";
$sql ="SELECT sum(amount) FROM purchase_table WHERE order_institution = '영남대병원' AND supply_institution='모더나' AND trade_type='s'";

  
   $ret = mysqli_query($con, $sql);
   $row = mysqli_fetch_array($ret);
   
   if($ret) 
   {
      if (is_null($row[0]))
      {
         $sell=0;
      }
      else
      {
         $sell=(int)$row[0];
      }
   }
   else 
   {
      echo "govdb 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   $sql ="SELECT sum(amount) FROM purchase_table WHERE order_institution = '영남대병원' AND supply_institution='모더나' AND trade_type='b'";

  
   $ret = mysqli_query($con, $sql);
   $row = mysqli_fetch_array($ret);
   
   if($ret) 
   {
      if (is_null($row[0]))
      {
         $buy=0;
      }
      else
      {
         $buy=(int)$row[0];
      }
   }
   else 
   {
      echo "govdb 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   $now=$buy-$sell;
echo "<font size=7>"."<center>".$now."</center>";

echo "    </td>\n";

//경북대
echo "    <td>\n";
$sql ="SELECT sum(amount) FROM purchase_table WHERE order_institution = '경북대병원' AND supply_institution='모더나' AND trade_type='s'";

  
   $ret = mysqli_query($con, $sql);
   $row = mysqli_fetch_array($ret);
   
   if($ret) 
   {
      if (is_null($row[0]))
      {
         $sell=0;
      }
      else
      {
         $sell=(int)$row[0];
      }
   }
   else 
   {
      echo "govdb 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   $sql ="SELECT sum(amount) FROM purchase_table WHERE order_institution = '경북대병원' AND supply_institution='모더나' AND trade_type='b'";

  
   $ret = mysqli_query($con, $sql);
   $row = mysqli_fetch_array($ret);
   
   if($ret) 
   {
      if (is_null($row[0]))
      {
         $buy=0;
      }
      else
      {
         $buy=(int)$row[0];
      }
   }
   else 
   {
      echo "govdb 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   $now=$buy-$sell;
echo "<font size=7>"."<center>".$now."</center>";
//대구
echo "    </td>\n";
echo "    <td>\n";
$sql ="SELECT sum(amount) FROM purchase_table WHERE order_institution = '대구병원' AND supply_institution='모더나' AND trade_type='s'";

  
   $ret = mysqli_query($con, $sql);
   $row = mysqli_fetch_array($ret);
   
   if($ret) 
   {
      if (is_null($row[0]))
      {
         $sell=0;
      }
      else
      {
         $sell=(int)$row[0];
      }
   }
   else 
   {
      echo "govdb 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   $sql ="SELECT sum(amount) FROM purchase_table WHERE order_institution = '대구병원' AND supply_institution='모더나' AND trade_type='b'";

  
   $ret = mysqli_query($con, $sql);
   $row = mysqli_fetch_array($ret);
   
   if($ret) 
   {
      if (is_null($row[0]))
      {
         $buy=0;
      }
      else
      {
         $buy=(int)$row[0];
      }
   }
   else 
   {
      echo "govdb 데이터 조회 실패!!!"."<br>";
      echo "실패 원인 :".mysqli_error($con);
      exit();
   }
   $now=$buy-$sell;
echo "<font size=7>"."<center>".$now."</center>";

echo "    </td>\n";
mysqli_close($con);
echo "</table>";

?>
<HTML>
<HEAD>
<META http-equiv="content-type" content="text/html; charset=utf-8">
</HEAD>
<BODY>
<style>
#pur { position : absolute; top : 89%; left : 60% }
</style>
<div id = "pur">
<button  type='button' onclick="location.href='supply_moderna.php'">백신 수주</button >
<button  type='button' onclick="location.href='product_moderna.php'">백신 생산</button >
</div>
</BODY>
</HTML>
</div>
</div>
</div>
</body>
</HTML>