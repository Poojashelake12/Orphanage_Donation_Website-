
<?php
session_start(); // Start the session

if (isset($_POST["sign_in"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once "database.php"; // Include the database connection code from "database.php"

    // Prepare the SQL query using prepared statements
    $stmt = $conn->prepare("SELECT * FROM admin  WHERE email = ? ");
    
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
    
        $result = $stmt->get_result();

        if ($result) {
            if ($result->num_rows == 1) {
                
                // Admin login successful
                $_SESSION["admin_username"] = $email;
                header("Location: admin dashboard.php"); // Redirect to the admin panel page
                exit();
            } else {
                echo "<div class='alert alert-danger'>Email or password is incorrect</div>";
            }
        } else {
            echo "Error: " . $conn->error; // Display any error related to the result set
        }
    
        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error; // Display any error related to the prepared statement
    }

    // Close the database connection
    $conn->close();
}
?>
