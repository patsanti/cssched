 <?php
$servername = "localhost";
$username = "root";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password,'test_join');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?> 