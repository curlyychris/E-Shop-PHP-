<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "assignment_acsc476";

 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>