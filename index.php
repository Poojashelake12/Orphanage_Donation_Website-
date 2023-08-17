
<?php
    if(isset($_POST["Submit"])){
      $name = $_POST["name"];
      $address = $_POST["address"];
      $mobile_no = $_POST["mobile_no"];
     $message = $_POST["message"];
    
     
     $errors =array();
     if(empty( $name ) OR empty( $address ) OR empty( $mobile_no ) ){
      array_push($errors,"All fields are required");
     }
     
    if(strlen($mobile_no)!=10){
      array_push($errors , " Mobile number should contain 10 digit");
//       $message = "This is a popup message!";
// $jsCode = "<script>alert('$message');</script>";



     }
    


     

     require_once "database.php";
     $sql = "SELECT * FROM donor WHERE mobile_no='$mobile_no'";
     $result=mysqli_query($conn,$sql);
     if(count($errors)>0){
      foreach($errors as $error){
       echo "<div class='alert alert-danger'>$error</div>";
      }
     }
     else 
     {
      
      //https://youtu.be/2MpZwFoBPjQ
      
      $sql ="INSERT INTO donor(name , address ,message,mobile_no)VALUES(?,?,?,?)";
      $stmt=mysqli_stmt_init($conn);  //it returns an object which we can use in mysqli_prepare()
      $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
      if($prepareStmt){
        mysqli_stmt_bind_param($stmt,"ssss",$name,$address,$message,$mobile_no);
        mysqli_stmt_execute($stmt);
        echo "<div class='aletr_alert-success' >Hello  dear $name Your request is have send to NGO,
        they will connect with you very soon..
         </div>";
        

      }
      else{
        die("something went wrong");
      }
      
     }

    }

    ?>
  