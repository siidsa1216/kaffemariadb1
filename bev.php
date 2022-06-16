<?php
require 'condb.php';
include 'include/sidebar.html';
include 'include/topbar.html';
include 'include/head.html';
?>
<body>
    <div class="bigside">
        <div class="container my-5" style="margin:20px;">
            <h1>Beverage Table</h1>
            <a class="btn btn-primary" href="/kaffemariadb/bev-create.php" role="button">Add Beverage</a>
        </div>
        <table class="table">
            <thead>
                <th>Beverage No.</th>
                <th>Flavor</th>
                <th>Quantity</th>
                <th>Size</th>
                <th>Price</th>
                <th>Payment Method</th>
                <th>Action</th>
            </thead>
    
            <tbody>
                <?php
                //read all data inn the table
    
                $sql = "SELECT * FROM beverage";
                $result= $connection->query($sql);
    
                if (!$result){
                    die("Invalid query: ".$connection->error);
                }
    
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    <td>".$row["beverage_No"]. "</td>
                    <td>".$row["beverage_flavor"]. "</td>
                    <td>".$row["beverage_qty"]. "</td>
                    <td>".$row["beverage_size"]. "</td>
                    <td>".$row["beverage_price"]. "</td>
                    <td>".$row["payment_method"]. "</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/kaffemariadb/bev-edit.php?beverage_No=$row[beverage_No]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/kaffemariadb/bev-delete.php?beverage_No=$row[beverage_No]'>Delete</a>
                    </td>
                </tr>";
                }
                
                ?>
            </tbody>
        </table>
    </div>   
</body>
>>>>>>> Stashed changes
</html>