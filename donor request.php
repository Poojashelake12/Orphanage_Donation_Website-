<!DOCTYPE html>
<html>
<head>
    <center>
    <title>Donor request</title>
</center>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            background-color:white;
            align:center;
        
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
           
        }
     
        th:nth-child(1){
            background-color:white;
            width:5%;
            
        }
        th:nth-child(2){
            background-color:white;
            width:20%;
            
        }

        th:nth-child(3){
            background-color:white;
            width:30%;
            
        }
        th:nth-child(4){
            background-color:white;
            width:10%;
            
        }

        th:nth-child(5){
            background-color:white;
            width:10%;
            
        }
        th:nth-child(6){
            background-color:white;
            width:11%;
            
        }
        body {
        background-image: url('img/admback.jpg');
        }
         
    </style>
</head>
<body> 
<center><h1 style="color:red">Donor Request</h1></center>




<?php
    require_once "database.php";
    // Query to retrieve entries from a table
    $sql = "SELECT * FROM donations";
    $result = $conn->query($sql);

    // Display entries if there are any
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Address</th>";
        echo " <th>Mobile_no</th>";
        echo "<th>Date</th>";
        echo "<th>Time</th>";
        echo "<th>Donation</th>";
       
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            // Access data using column names
            $id = $row['id'];
            $name = $row['name'];
            $address= $row['address'];
            $mobile_no = $row['mobile_no'];
            $date = $row['date'];
            $time= $row['time'];
            $donation= $row['donation'];
           

            // Display the entry
            echo "<table>";
        echo "<tr>";
        echo "<th>$id</th>";
        echo "<th>$name</th>";
        echo "<th>$address</th>";
        echo "<th>$mobile_no</th>";
        echo "<th>$date</th>";
        echo "<th>$time</th>";
        echo "<th>$donation</th>";
       
        }
        echo "</table>";
    }
       
    else {
        echo "No entries found.";
    }

    // Close the database connection
    
    ?>
    </body>
</html>

