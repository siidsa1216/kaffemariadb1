
<?php
if(isset($_GET['beverage_No'])){
    $beverage_No = $_GET['beverage_No'];

    require 'condb.php';
    
    $sql = "DELETE FROM beverage WHERE beverage_No = $beverage_No";
    $connection->query($sql);

    header("location:/kaffemariadb/bev.php");
    exit;

}
?>