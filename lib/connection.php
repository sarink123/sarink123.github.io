<?php $host="localhost";
$root="root";
$pass="";
$dbname="qlhh";
try{
  $options = array(
PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
$conn = new PDO("mysql:host=$host;dbname=$dbname", $root, $pass,$options);
 // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  $conn->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));}
catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }