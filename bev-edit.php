<?php
require 'condb.php';
include 'include/head.html';

$beverage_No="";
$beverage_flavor="";
$beverage_qty="";
$beverage_size="";
$beverage_price="";
$payment_method="";


$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($_GET['beverage_No'])){
        header("location:/kaffemariadb/bev.php");
        exit;
    }

    $beverage_No = $_GET['beverage_No'];
    $sql = "SELECT * FROM beverage WHERE beverage_No = $beverage_No";

    $result= $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location:/kaffemariadb/bev.php");
        exit;
    }

    $beverage_flavor= $row["beverage_flavor"];
    $beverage_qty= $row["beverage_qty"];
    $beverage_size= $row["beverage_size"];
    $beverage_price= $row["beverage_price"];
    $payment_method= $row["payment_method"];

}

else{
    $beverage_flavor=$_POST["beverage_flavor"];
    $beverage_qty=$_POST["beverage_qty"];
    $beverage_size=$_POST["beverage_size"];
    $beverage_price=$_POST["beverage_price"];
    $payment_method=$_POST["payment_method"];

    do {
        if(empty($beverage_flavor) || empty($beverage_qty) || empty($beverage_size) || empty($beverage_price) || empty($payment_method)) 
        {
            $errorMessage = "Please fill up the required fields";
        break;        
        } 

        $beverage_No = $_GET['beverage_No'];

        $sql = "UPDATE beverage SET beverage_flavor = '$beverage_flavor', beverage_qty = '$beverage_qty',  beverage_size= '$beverage_size', beverage_price='$beverage_price', payment_method='$payment_method'
        WHERE beverage_No=$beverage_No";

        $result= $connection->query($sql);

        if(!$result) 
        {
            $errorMessage ="Invalid query: ". $connection->error;
            break;      
        } 
        $successMessage = "Supplier updated successfully!";

        header("location:/kaffemariadb/bev.php");
        exit;
    }while(false);

}
?>

<body>
    <div class="container my-5">
        <h2>New Beverage</h2>

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
            <input type="hidden" name="beverage_No" value="<?php echo $beverage_No; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">beverage_flavor</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="beverage_flavor" value="<?php echo $beverage_flavor; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">beverage_qty</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="beverage_qty" value="<?php echo $beverage_qty; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">beverage_size</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="beverage_size" value="<?php echo $beverage_size; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">beverage_price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="beverage_price" value="<?php echo $beverage_price; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">payment_method</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="payment_method" value="<?php echo $payment_method; ?>">
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
                    <a class="btn btn-outline-primary" href="/kaffemariadb/bev.php" role="button">Cancel</a>
                </div>
            </div>  
        </form>  
    </div>
</body>
</html>