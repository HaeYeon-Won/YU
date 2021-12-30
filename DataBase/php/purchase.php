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
<h1> 백신 발주</h1>
<FORM METHOD="post" ACTION="purchase_result.php">
      
      기관명 : <INPUT TYPE = "text" NAME="order_institution"> <br>
      백신종류 : <INPUT TYPE = "text" NAME="supply_institution">  <br>
      수량 : <INPUT TYPE = "text" NAME="amount"> <br>
      <BR><BR>
      위 수량만큼 발주 하시겠습니까?
      <INPUT TYPE="submit" VALUE="발주">
     <BR><BR><BR><BR><BR>
</FORM>
<button  type='button' onclick="location.href='admin.php'">main화면</button >
</div>
</body>
</HTML>