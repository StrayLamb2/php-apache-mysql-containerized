<?php
// Establish connection to the database
define('DB_SERVER', 'mysql');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'rootpassword');
define('DB_DATABASE', 'mysql');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
