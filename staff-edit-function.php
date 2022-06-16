<?php
require 'condb.php';
include 'include/head.html';

$staffID="";
$staff_fname="";
$staff_mname="";
$staff_lname="";
$staff_address="";
$staff_contactno="";
$staff_position="";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($_GET['staffID'])){
        header("location:/kaffemariadb/staff.php");
        exit;
    }

    $staffID = $_GET['staffID'];

    $sql = "SELECT * FROM staff WHERE staffID=$staffID";
    $result= $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location:/kaffemariadb/staff.php");
        exit;
    }

    $staff_fname=$row["staff_fname"];
    $staff_mname=$row["staff_mname"];
    $staff_lname=$row["staff_lname"];
    $staff_address=$row["staff_address"];
    $staff_contactno=$row["staff_contactno"];
    $staff_position=$row["staff_address"];

}
else{
    $staff_fname=$_POST["staff_fname"];
    $staff_mname=$_POST["staff_mname"];
    $staff_lname=$_POST["staff_lname"];
    $staff_address=$_POST["staff_address"];
    $staff_contactno=$_POST["staff_contactno"];
    $staff_position=$_POST["staff_position"];

    do {
        if(empty($staff_fname) || empty($staff_lname) || empty($staff_contactno) || empty($staff_address) || empty($staff_position)) 
        {
            $errorMessage = "Please fill up the required fields";
        break;        
        } 
        
        $staffID = $_GET['staffID'];

        $sql = "UPDATE staff ".
        "SET staff_fname = '$staff_fname', staff_mname = '$staff_mname',  staff_lname= '$staff_lname', staff_contactno='$staff_contactno', staff_address='$staff_address', staff_position='$staff_position' ".
        "WHERE staffID=$staffID ";
        
        $result= $connection->query($sql);

        if(!$result) 
        {
            $errorMessage ="Invalid query: ". $connection->error;
            break;      
        } 
        $successMessage = "Staff updated successfully!";

        header("location:/kaffemariadb/staff.php");
        exit;
    }while(false);

}
?>

<body>
    <div class="container my-5">
        <h2>Staff List</h2>

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
            <input type="hidden" name="staffID" value="<?php echo $staffID; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="staff_fname" value="<?php echo $staff_fname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Middle Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="staff_mname" value="<?php echo $staff_mname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="staff_lname" value="<?php echo $staff_lname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="staff_address" value="<?php echo $staff_address; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contact No.</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="staff_contactno" value="<?php echo $staff_contactno; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Position</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="staff_position" value="<?php echo $staff_position; ?>">
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
                    <a class="btn btn-outline-primary" href="/kaffemariadb/staff.php" role="button">Cancel</a>
                </div>
            </div>  
        </form>  
    </div>
</body>
</html>