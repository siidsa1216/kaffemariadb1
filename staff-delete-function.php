<?php
if(isset($_GET['staffID'])){
    $staffID = $_GET['staffID'];

    require 'condb.php';
    
    $sql = "DELETE FROM staff WHERE staffID = $staffID";
    $connection->query($sql);

    header("location:/kaffemariadb/staff.php");
    exit;

}
?>