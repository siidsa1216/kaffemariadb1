<?php
if(isset($_GET['ingredient_ID'])){
    $ingredient_ID = $_GET['ingredient_ID'];

    require 'condb.php';
    
    $sql = "DELETE FROM ingredient WHERE ingredient_ID = $ingredient_ID";
    $connection->query($sql);

    header("location:/kaffemariadb/inventory.php");
    exit;

}
?>