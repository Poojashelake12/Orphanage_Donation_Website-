<!DOCTYPE html>
<html>
<head>
    <center>
    <title>Donor Enteries</title>
</center>
<style>
        table {
            border-collapse: collapse;
            width: 100%;
            background-color:white;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: white;
        }
        body {
        background-image: url('img/admback.jpg');
        }
         
    </style>
</head>
<body > 
<center><h1 style="color:red">Donor Enteries</h1></center>

    <?php
    require_once "database.php";
    // Query to retrieve entries from a table
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    // Display entries if there are any
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
       
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            // Access data using column names
            $id = $row['id'];
            $full_name = $row['full_name'];
            $email = $row['email'];
           

            // Display the entry
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$full_name</td>";
            echo "<td>$email</td>";
           
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No entries found.";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>






