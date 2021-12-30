<HTML>
<Head>
<META http-equiv="content-type" content="text/html; charset=utf-8">
<title>Pfizer</title>
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
<img src="Pfizer_logo.png" width = 250, height = auto>
</div>

<div id = "form">
<?php
   $con=mysqli_connect("localhost", "root", "1234", "govdb") or die("MySQL 접속 실패 !!");
   $trade_type="S";
   $amount = $_POST["amount"];
   $order_date=date("Y-m-d");
   $order_institution = $_POST["order_institution"];
   $supply_institution = '화이자';
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
 $sql ="SELECT vaccine_inventory FROM company_table WHERE company_name = '화이자'";
 
   
    $ret = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($ret);
    
    if($ret) 
    {
       if (is_null($row[0]))
       {
          $contain=0;
       }
       else
       {
          $contain=(int)$row[0];
       }
    }
    else 
    {
       echo "govdb 데이터 조회 실패!!!"."<br>";
       echo "실패 원인 :".mysqli_error($con);
       exit();
    }
    
    //

   $sql ="INSERT INTO purchase_table VALUES('".$count."','".$trade_type."','".$amount."','".$order_date."','".$order_institution."','".$supply_institution."')";
   $now_amount=$contain-(int)$amount;
   if($contain>=(int)$amount)
   {
      $ret = mysqli_query($con, $sql);   
      echo "<h1> 백신 수주 결과</h1>";
      if($ret)
      {
         echo "수주가 성공적으로 완료됨";
         $sql ="UPDATE company_table SET vaccine_inventory='".$now_amount."', vaccine_production = vaccine_production+'".$amount."' WHERE company_name='화이자'" ;
         $ret = mysqli_query($con, $sql); 
        
      }
      else
      {
         echo "데이터 입력 실패!"."<br>";
         echo "실패 원인: ".mysqli_error($con);
      }
   }
   else
   {
      echo "<h1> 백신 구입 결과</h1>";
      echo "수주 실패!<BR>";
      echo  "재고량 부족";
   }
   
   mysqli_close($con);
?>
     <BR><BR><BR><BR><BR>
</FORM>
<button  type='button' onclick="location.href='Pfizer.php'">main화면</button >
</div>
</body>
</HTML>