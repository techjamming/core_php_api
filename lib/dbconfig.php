<?php
// MySQLi connection
$mysqli = new mysqli("localhost", "root", "", "core_php_api");//"localhost", "username", "password", "database"
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Close connection
// $mysqli->close();
?>