<?php
include 'index.php';
session_start();

if(isset($_POST['forgot_password'])){

  $name=$_POST['name'];
  $email=$_POST['email'];
  $pwd=md5($_POST['new_password']);
  
  $query="select * from users where name='$name' AND email='$email'";
  
  
  $result=mysqli_query($conn,$query);
  $num=mysqli_fetch_array($result);
  if($num>0){
  mysqli_query($conn,"update users set password='$pwd' where email='$email' AND name='$name'");
  $_SESSION['email']=$email;
  header('location:login.php');
  }else{
  echo"<script>alert('something wrong try again')</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
      <link rel="stylesheet" href="css/style_login.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Forgot Password</title>
</head>
<body>
<div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="images/photoshop.png" alt="">
        <div class="text">
          <span class="text-1">Rubrik Grafis</span>
          <span class="text-2">Kelas design grafis nomer 1 di Indonesia</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Forgot Password</div>
          <form action="forgot_password.php" method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="enter your name" required class="box">
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="enter your email" required class="box">
                <!--<input type="email" placeholder="Enter your email" required>-->
              </div>
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" name="new_password" placeholder="enter your new password" required class="box">
              </div>
              <div class="button input-box">
               <input type="submit" name="forgot_password" value="Change" class="btn">
                <!--<input type="submit"  name="submit" value="Sumbit">-->
              </div>
              <div class="text sign-up-text">Kembali ke menu login? <a href="login.php">log In</a></div>
            </div>
        </form>
      </div>
</body>
</html>