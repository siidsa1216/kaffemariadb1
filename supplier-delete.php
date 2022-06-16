<?php
if(isset($_GET['supplier_ID'])){
    $supplier_ID = $_GET['supplier_ID'];

    require 'condb.php';
    
    $sql = "DELETE FROM supplier WHERE supplier_ID = $supplier_ID";
    $connection->query($sql);

    header("location:/kaffemariadb/supplier.php");
    exit;

}
?>