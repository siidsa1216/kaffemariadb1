<?php
if(isset($_GET['item_No'])){
    $item_No = $_GET['item_No'];

    require 'condb.php';
    
    $sql = "DELETE FROM item WHERE item_No = $item_No";
    $connection->query($sql);

    header("location:/kaffemariadb/inventory.php");
    exit;

}
?>