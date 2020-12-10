<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["logged"]);
header("Location:index.php");
?>