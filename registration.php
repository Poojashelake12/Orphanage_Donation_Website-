



<!DOCTYPE html>
<html lang="en">
<head>
<style>
         body {
        background-image: url('img/admback.jpg');
         }
         
        </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
<body>
  <div class="container">
    <?php
    if(isset($_POST["Submit"])){
      $fullname = $_POST["fullname"];
      $email = $_POST["email"];
      $password = $_POST["password"];
     $confirm = $_POST["confirm_password"];
     $passwordHash=password_hash($password,PASSWORD_DEFAULT);
     $errors =array();
     
     if(empty( $fullname ) OR empty( $email ) OR empty( $password ) OR empty( $confirm )){
      array_push($errors,"All fields are required");
     }
     if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      array_push($errors , "Invalid Email");
     }
     if(strlen($password)<8){
      array_push($errors , "Password should be greater than 8 characters");

     }
     if($password !==$confirm){
     
      array_push($errors,"Password doesn't match");
     }

     
     require_once "database.php";
     $sql = "SELECT * FROM users WHERE email='$email'";
     $result=mysqli_query($conn,$sql);
     $rowCount=mysqli_num_rows($result);
     if($rowCount>0){
      array_push($errors,"email already exist");
     }


     if(count($errors)>0){
      foreach($errors as $error){
       echo "<div class='alert alert-danger'>$error</div>";
      }
     }
     else 
     {
      
      //https://youtu.be/2MpZwFoBPjQ
      
      $sql ="INSERT INTO users(full_name , email ,password)VALUES(?,?,?)";
      $stmt=mysqli_stmt_init($conn);  //it returns an object which we can use in mysqli_prepare()
      $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
      if($prepareStmt){
        mysqli_stmt_bind_param($stmt,"sss",$fullname,$email,$passwordHash);
        mysqli_stmt_execute($stmt);
        echo "<div class='aletr alert-success'>Registration successfully</div>";
        header("Location:login.php");
        
      }
      else{
        die("something went wrong");
      }
      
     }

    }

    ?>
    <form action="registration.php" method="post">
       <div class="form-group">
        <input type="text" class="form-control" name="fullname" placeholder="Full Name">
       </div>
       <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="E-mail">
       </div>
       <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password">
       </div>
       <div class="form-group">
        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
       </div>
       <div class="form-group">
        <input type="submit"  class="btn btn-primary" value="Register" name="Submit" > <br>If you have already account
        <a class ="form-group" href="login.php"> Login Here </a>
       </div>
    </form>
  </div>  
</body>
</html>