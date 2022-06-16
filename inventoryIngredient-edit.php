<?php
require 'condb.php';
include 'include/head.html';

$ingredient_name="";
$ingredient_description="";
$ingredient_price="";
$ingredient_expiry="";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($_GET['ingredient_ID'])){
        header("location:/kaffemariadb/home.php");
        exit;
    }

    $ingredient_ID = $_GET['ingredient_ID'];

    $sql = "SELECT * FROM ingredient WHERE ingredient_ID=$ingredient_ID";
    $result= $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location:/kaffemariadb/home.php");
        exit;
    }

    $ingredient_name=$row["ingredient_name"];
    $ingredient_description=$row["ingredient_description"];
    $ingredient_price=$row["ingredient_price"];
    $ingredient_expiry=$row["ingredient_expiry"];

}
else{
    $ingredient_name=$_POST["ingredient_name"];
    $ingredient_description=$_POST["ingredient_description"];
    $ingredient_price=$_POST["ingredient_price"];
    $ingredient_expiry=$_POST["ingredient_expiry"];

    do {
        if(empty($ingredient_name) || empty($ingredient_description) || empty($ingredient_price) || empty($ingredient_expiry)) 
        {
            $errorMessage = "Please fill up the required fields";
        break;        
        } 
        
        $ingredient_ID = $_GET['ingredient_ID'];

        $sql = "UPDATE ingredient ".
        "SET ingredient_name = '$ingredient_name', ingredient_description = '$ingredient_description',  ingredient_price= '$ingredient_price', ingredient_expiry='$ingredient_expiry' ".
        "WHERE ingredient_ID=$ingredient_ID ";
        
        $result= $connection->query($sql);

        if(!$result) 
        {
            $errorMessage ="Invalid query: ". $connection->error;
            break;      
        } 
        $successMessage = "Ingredient updated successfully!";

        header("location:/kaffemariadb/inventory.php");
        exit;
    }while(false);

}
?>
<body>
    <div class="container my-5">
        <h2>New Ingredient</h2>

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
            <input type="hidden" name="ingredient_ID" value="<?php echo $ingredient_ID; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Ingredient Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ingredient_name" value="<?php echo $ingredient_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Ingredient Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ingredient_description" value="<?php echo $ingredient_description; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Ingredient Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ingredient_price" value="<?php echo $ingredient_price; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Ingredient Expiration Date</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ingredient_expiry" value="<?php echo $ingredient_expiry; ?>">
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
                    <a class="btn btn-outline-primary" href="/kaffemariadb/home.php" role="button">Cancel</a>
                </div>
            </div>  
        </form>  
    </div>
</body>
</html>