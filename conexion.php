<?php
$host="localhost";
$user="root";
$password="";
$db="incidencias";
$conexion = new mysqli($host,$user,$password,$db);
mysqli_set_charset($conexion, "utf8");
?>