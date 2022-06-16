<?php
require 'condb.php';
include 'include/sidebar.html';
include 'include/topbar.html';
include 'include/head.html';
?>

<body>
    <div class="bigside">
         <div class="container my-5" style="margin:20px;">
            <h1>Supplier Table</h1>
            <a class="btn btn-primary" href="/kaffemariadb/supplier-create.php" role="button">Add Supplier</a>
    
        </div>
        <table class="table">
            <thead>
                <th>Supplier ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Contact No.</th>
                <th>Address</th>
                <th>Action</th>
            </thead>
    
            <tbody>
                <?php
                $sql = "SELECT * FROM supplier";
                $result= $connection->query($sql);
    
                if (!$result){
                    die("Invalid query: ".$connection->error);
                }
    
                while($row =$result->fetch_assoc()){
                    echo "<tr>
                    <td>".$row["supplier_ID"]. "</td>
                    <td>".$row["supplier_fname"]. "</td>
                    <td>".$row["supplier_mname"]. "</td>
                    <td>".$row["supplier_lname"]. "</td>
                    <td>".$row["supplier_ContactNo"]. "</td>
                    <td>".$row["supplier_address"]. "</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/kaffemariadb/supplier-edit.php?supplier_ID=$row[supplier_ID]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/kaffemariadb/supplier-delete.php?supplier_ID=$row[supplier_ID]'>Delete</a>
                    </td>
                </tr>";
                }
                
                ?>
            </tbody>
        </table>
    </div>

    </div>
    
</body>
</html>