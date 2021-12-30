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
   $vaccine_inventory = $_POST["amount"];
  
 

   $sql ="UPDATE company_table SET vaccine_inventory = vaccine_inventory+'".$vaccine_inventory."' 
   WHERE company_name='화이자'" ;
    echo "<h1> 백신 생산 결과</h1>";
    $ret = mysqli_query($con, $sql); 
      if($ret)
      {
         echo "생산이 성공적으로 완료됨";
        
      }
      else
      {
         echo "데이터 입력 실패!"."<br>";
         echo "실패 원인: ".mysqli_error($con);
      }
 
   mysqli_close($con);
?>
<BR><BR><BR><BR><BR>
<button  type='button' onclick="location.href='Pfizer.php'">main화면</button >
</div>
</body>
</HTML>