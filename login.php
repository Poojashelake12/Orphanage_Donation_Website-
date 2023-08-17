



<<!DOCTYPE html>
<html lang="en">
<head>
    <style>
         body {
        background-image: url('img/admback.jpg');
         }
         
        </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container" style="background-color:white">
   <center> <h1 style="color:red"> Login Here <h1> </center>
   <br>

<?php

if(isset($_POST["login"])){
   
    $email = $_POST["email"];
    $password = $_POST["password"];
    require_once "database.php";
    $sql="SELECT * FROM users WHERE email='$email'";
    $result=mysqli_query($conn,$sql);
    $user=mysqli_fetch_array($result,MYSQLI_ASSOC);

    if($user){

        if(password_verify($password,$user['password'])){
            session_start();
            $_SESSION["user"]="yes";
            header("Location:dashboard.php");
            die();
        }
        else{
            echo "<div class='alert alert-danger'>Password does not exists</div>";
        }
    }
    else{
        echo "<div class='alert alert-danger'>Email does not exists</div>";
    }
}
?>

<div  style="display: flex;">
<form action="login.php" method="post">
    <h4> User Login </h4>
<div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="E-mail">
       </div>
       <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password">
       </div>
       <div class="form-group">
        <input type="submit"  class="btn btn-primary" value="Login" name="login" ><br> if you do not have account
        <a class="form-group" href="registration.php">Register here</a>
       </div>
</form>
&emsp; &emsp;
<form action="admin.php" method="post">
    <h4> Admin Login </h4>
<div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="E-mail">
       </div>
       <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password">
       </div>
       <div class="form-group">
        <input type="submit"  class="btn btn-primary" value="Login" name="sign_in" >
       </div>
</form>
</div>
</body>
</html>