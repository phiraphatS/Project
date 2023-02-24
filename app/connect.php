<?php

// Database credentials
$server = "localhost";
$username = "root";
$password = "";
$dbname = "fasion_product_v0.1";

// Create a connection
$conn = mysqli_connect($server, $username, $password, $dbname);
mysqli_query($conn, 'SET CHARACTER SET UTF8');

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

?>
<!-- Once you have established a connection, you can use the $conn variable to run queries and interact with the database. -->




