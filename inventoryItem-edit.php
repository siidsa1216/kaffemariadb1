<?php
require 'condb.php';
include 'include/head.html';

$item_name="";
$item_qty="";
$item_size="";
$item_description="";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($_GET['item_No'])){
        header("location:/kaffemariadb/inventory.php");
        exit;
    }

    $item_No = $_GET['item_No'];

    $sql = "SELECT * FROM item WHERE item_No=$item_No";
    $result= $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location:/kaffemariadb/inventory.php");
        exit;
    }

    $item_name=$row["item_name"];
    $item_qty=$row["item_qty"];
    $item_size=$row["item_size"];
    $item_description=$row["item_description"];

}
else{
    $item_name=$_POST["item_name"];
    $item_qty=$_POST["item_qty"];
    $item_size=$_POST["item_size"];
    $item_description=$_POST["item_description"];

    do {
        if(empty($item_name) || empty($item_qty) || empty($item_size) || empty($item_description)) 
        {
            $errorMessage = "Please fill up the required fields";
        break;        
        } 
        
        $item_No = $_GET['item_No'];

        $sql = "UPDATE item ".
        "SET item_name = '$item_name', item_qty = '$item_qty',  item_size= '$item_size', item_description='$item_description' ".
        "WHERE item_No=$item_No ";
        
        $result= $connection->query($sql);

        if(!$result) 
        {
            $errorMessage ="Invalid query: ". $connection->error;
            break;      
        } 
        $successMessage = "Item updated successfully!";

        header("location:/kaffemariadb/inventory.php");
        exit;
    }while(false);

}
?>

<body>
    <div class="container my-5">
        <h2>New Item</h2>

        <?php
        if (!empty($errorMessage)){
            echo"
            <div class='alert alert-warning alert-dismissible fade show' role= 'alert'>
            <strong> $errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }

        ?>
        <form method = 'POST'>
            <input type="hidden" name="item_No" value="<?php echo $item_No; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Item Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="item_name" value="<?php echo $item_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Item Quantity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="item_qty" value="<?php echo $item_qty; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Item Size</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="item_size" value="<?php echo $item_size; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Item Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="item_description" value="<?php echo $item_description; ?>">
                </div>
            </div>
            
            <?php
            if (!empty($successMessage)){
                echo"
                <div class='alert alert-warning alert-dismissible fade show' role= 'alert'>
                <strong> $successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            ?>
             <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/kaffemariadb/home1.html" role="button">Cancel</a>
                </div>
            </div>  
        </form>  
    </div>
</body>
</html>