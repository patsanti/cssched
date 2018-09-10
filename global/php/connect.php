 <?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password, 'csit_advising_scheduler');

// Check connection
if ($conn->connect_error) {
    exit("Connection failed: " . $conn->connect_error);
}

?>