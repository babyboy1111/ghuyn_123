<!DOCTYPE html> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<link rel="stylesheet" href="./css/style.css"/> 
</head> 
<body> 
 <section>   
    <div class="login-img column col-half">

     <img src="http://localhost:81/demo/login/garden.jpg" class="garden-login" alt="garden">
     </div>
  <div class="container column col-half">  
<form action='login.php' class="dangnhap" method='POST'> 
Tên đăng nhập  <input type='text' name='username' /> 
Mật khẩu  <input type='password' name='password' /> 
<input type='submit' class="button" name="dangnhap" value='Đăng nhập' /> 
<!-- <a href='dangky.php' title='Đăng ký'>Đăng ký</a>  -->
<?php require 'xuly.php';?> 
<form> 
    <p>"username:admin"</p>

    <p>"password:admin123"</p>
</div>
</section>
</body> 
</html>