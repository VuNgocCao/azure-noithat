
<?php
        $servername = "noithatgiadinh.mysql.database.azure.com";
        $username = "adminnoithat@noithatgiadinh";
        $password = "admin@123";
        $db="noithatgiadinh";
        // Create connection
        $conn = mysqli_connect($servername, $username, $password,$db);      
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        // echo "Connected successfully";
?> 
