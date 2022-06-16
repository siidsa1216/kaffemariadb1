<?php
$servername = "localhost";
$username = "root";
$password = "";
$database="kaffemariadb"; //name y=of your db 

$connection = new mysqli($servername,  $username, $password, $database); 

if(!$connection = mysqli_connect($servername,  $username, $password, $database))
{
    die("Connection Failes". mysqli_connect_error());
}
?>