<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db_name = "db";
$conn = new mysqli($servername, $username, $password, $db_name, 3306);

if($conn->connect_error){
    die("Connection Fail".$conn->connect_error);
}
echo "";

?>