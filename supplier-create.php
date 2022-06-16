<?php
 require 'condb.php';
 include 'include/head.html';
 
$supplier_fname="";
$supplier_mname="";
$supplier_lname="";
$supplier_ContactNo="";
$supplier_address="";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $supplier_fname=$_POST["supplier_fname"];
    $supplier_mname=$_POST["supplier_mname"];
    $supplier_lname=$_POST["supplier_lname"];
    $supplier_ContactNo=$_POST["supplier_ContactNo"];
    $supplier_address=$_POST["supplier_address"];
    
    do {
        if(empty($supplier_fname) || empty($supplier_lname) || empty($supplier_ContactNo) || empty($supplier_address)) 
        {
            $errorMessage = "Please fill up the required fields";
        break;        
        } 
        // add new client into the db
        $sql = "INSERT INTO supplier (supplier_fname,supplier_mname,supplier_lname,supplier_ContactNo,supplier_address)".
                "VALUES('$supplier_fname', '$supplier_mname','$supplier_lname','$supplier_ContactNo', '$supplier_address')";
       
        $result= $connection->query($sql);

        if (!$result){
            $errorMessage= "Invalid query: ".$connection->error;
            break;
        }

        $supplier_fname="";
        $supplier_mname="";
        $supplier_lname="";
        $supplier_ContactNo="";
        $supplier_address="";
        
        $successMessage = "Supplier added successfully!";
       
        header("location:/kaffemariadb/supplier.php");
        exit;

    }while(false);
}
?>
<body>
    <div class="container my-5">
        <h2>New Supplier</h2>

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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="supplier_fname" value="<?php echo $supplier_fname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Middle Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="supplier_mname" value="<?php echo $supplier_mname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="supplier_lname" value="<?php echo $supplier_lname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contact No.</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="supplier_ContactNo" value="<?php echo $supplier_ContactNo; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="supplier_address" value="<?php echo $supplier_address; ?>">
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

                    <a class="btn btn-outline-primary" href="/kaffemariadb/supplier.php" role="button">Cancel</button></a>

                </div>
            </div>  
        </form>  
    </div>
</body>
</html>