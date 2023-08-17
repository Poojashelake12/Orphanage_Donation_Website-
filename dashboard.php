<!DOCTYPE html>
<html lang="en">
<head>
    <style>


body {
  background-image: url('img/admback.jpg');
}
        form {
  margin-top:5px; 
  padding: 0 5px;
  background:lightgray;  
  width: 600px;
  height: 500px;
}

.heading{
    color:red;
    font-family:verdana
    font-size:20px;
}
.aletr_alert-success {
  
  background-color: white;
  border: 1px solid #eaeaea;
  color: blue;
}

    </style>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" herf="css/style.css">
    <title>Dashboard</title>
</head>
<body>
    
<p align="right">
    <a class="btn btn-primary" href="index.html" >
    <button>Log out</button>
  </a> 
</p>
<center>
    <h class="heading" style="font-size:3vw"><b>Welcome Back</b></h1> </center>
    <center>
    
   
<?php
    if(isset($_POST["Submit"])){
      $name = $_POST["name"];
      $address = $_POST["address"];
      $mobile_no = $_POST["mobile_no"];
     $age= $_POST["age"];
     $date = $_POST["date"];
     $time = $_POST["time"];
     $donation = $_POST["donation"];
 $errors =array();
     if(empty( $name ) OR empty( $address ) OR empty( $mobile_no )OR empty( $age ) OR empty( $date ) OR empty( $time ) OR empty( $donation )  ){
      array_push($errors,"All fields are required");
     }
     
    if(strlen($mobile_no)!=10){
      array_push($errors , " Mobile number should contain 10 digit");
//       $message = "This is a popup message!";
// $jsCode = "<script>alert('$message');</script>";



     }
    


     

     require_once "database.php";
     $sql = "SELECT * FROM donations WHERE mobile_no='$mobile_no'";
     $result=mysqli_query($conn,$sql);
     if(count($errors)>0){
      foreach($errors as $error){
       echo "<div class='alert alert-danger'>$error</div>";
      }
     }
     else 
     {
      
      //https://youtu.be/2MpZwFoBPjQ
      
      $sql ="INSERT INTO donations(name , address,mobile_no,age,date,time,donation)VALUES(?,?,?,?,?,?,?)";
      $stmt=mysqli_stmt_init($conn);  //it returns an object which we can use in mysqli_prepare()
      $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
      if($prepareStmt){
        mysqli_stmt_bind_param($stmt,"sssssss",$name,$address,$mobile_no,$age,$date,$time,$donation);
        mysqli_stmt_execute($stmt);
       
        echo "<div class='aletr_alert-success' >Hello  dear $name Your request for donation of $donation is have send to NGO,
        they will connect with you very soon..
         </div>";
        

      }
      else{
        die("something went wrong");
      }
      
     }

    }

    ?>
  
<form class="donation-form" action="dashboard.php" method="post">
    <div class="text"> <b>Fill This Form For Donation</b> </div>
    <br><br>
   
    <input type="text" class="donation" name="name" placeholder="Your Name">
    <input type="text" class="donation" name="address" placeholder="Adderss">
     
     

</div>
<br> <br>
<input type="text" class="donation" name="mobile_no" placeholder="Mobile Number">
    <input type="text" class="donation" name="age" placeholder="Your Age">
     
     

</div>
<br> <br>

<input type="date" class="donation" name="date" placeholder="Date">
    <input type="time" class="donation" name="time" placeholder="Time">
     
     

</div>
<br> <br>
<center>
<select name="donation" id="donation">
 <option value="">Choose Donation </option>
<option value="food">Fruits</option>
<option value="clothes">Clothes</option>
<option value="footware">Footware</option>
<option value="books">Books</option>
                                                       
<option value="gadget">Other</option>
 </select>
<br><br>
 <input type="submit"  class="btn btn-primary" value="Submit" name="Submit" >
</center>


</form>
</center>
</div>
</body>
</html>

