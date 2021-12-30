<HTML>
<Head>
<META http-equiv="content-type" content="text/html; charset=utf-8">
<title>goverment</title>
</Head>
<body>
<style>
img {display : inline-block; position: fixed; top:27px; left:20px}
h2{display : inline-block}
h5, h6 { display : inline-block }
h5 { color : #0d4199 }
#header{width:100%; height:60px; display : block;}
.ss {display : inline-block; color:#333; position : absolute; left : 85% ; }
.sss {display : inline-block; color:#333; position : absolute; left : 70% ; }
.st {display : inline-block; color:#333}
 #content{position:absolute; top:12%; left:15%; display : inline-block}
 #form{position: absolute; top:20%; left : 35%; text-align :center;
      display:absolute; width:30%; height:50%; border : 2.5px solid #0d4199; border-radius:10px;}
 .form_text{ position:relative; top:38%; right:2.8%}
 
  #form2{
      display:absolute; width:50%; height:50%;  border-radius:10px;}
 .st { display : inline-block }
 .s {display : inline-block; color:#333; position : absolute; left : 85% ; top : 15%}


</style>
<div id = "header">
<img src="login.png" width = 250, height = auto>
</div>

<div id = "form">
<?php
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   $trade_type="B";
   $amount = $_POST["amount"];
   $order_date=date("Y-m-d");
   $order_institution = $_POST["order_institution"];
   $supply_institution = $_POST["supply_institution"];
   $sql_2 = "SELECT count(*) FROM purchase_table";
   $result_set = mysqli_query($con,$sql_2);
   if($result_set)
   {
    $row=mysqli_fetch_array($result_set);
    $count= (int)$row[0]+1;// 다음 번호
   }
   else{
    echo "데이터 입력 실패!"."<br>";
    echo "실패 원인: ".mysqli_error($con);
   }

    //현재 제고량 파악
    $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
    if(mysqli_connect_error($con))
 {
     echo "접속실패", mysqli_connect_error();
     exit();
 }


   $sql ="INSERT INTO purchase_table VALUES('".$count."','".$trade_type."','".$amount."','".$order_date."','".$order_institution."','".$supply_institution."')";
      $ret = mysqli_query($con, $sql);  
      echo "<h1> 백신 발주 요청 결과</h1>";
      if($ret)
      {
         echo "발주 요청이 성공적으로 완료됨";
      }
      else
      {
         echo "데이터 입력 실패!"."<br>";
         echo "실패 원인: ".mysqli_error($con);
      }

  
   
   mysqli_close($con);
?>
     <BR><BR><BR><BR><BR>
</FORM>
<button  type='button' onclick="location.href='admin.php'">main화면</button >
</div>
</body>
</HTML>