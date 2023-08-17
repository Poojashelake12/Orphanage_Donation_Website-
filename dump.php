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
            background-color:gray;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body style="background-color:lightgray"> 
<center><h1 style="color:red">Donor Enteries</h1></center>

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
        echo "<th>Mobile_NO</th>";
        echo "<th>Date</th>";
        echo "<th>Time</th>";
        echo "<th>Donation</th>";
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            // Access data using column names
            $id = $row['id'];
            $name = $row['name'];
            $address= $row['address'];
            $mobile_no = $row['mobile_number'];
            $date = $row['date'];
            $time= $row['time'];
            $donation= $row['donation'];

            // Display the entry
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            echo "<td>$address</td>";
            echo "<td>$mobile_no</td>";
            echo "<td>$date</td>";
            echo "<td>$time</td>";
            echo "<td>$donation</td>";
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
