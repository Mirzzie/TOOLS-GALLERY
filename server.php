<?php
$conn = new mysqli('db', # service name
    'php_docker', # username
    'password', # password
    'scheduler' # db name
    );
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
