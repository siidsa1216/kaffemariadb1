<?php
require 'condb.php';
include 'include/sidebar.html';
include 'include/topbar.html';
include 'include/head.html';

?>
<body>
    <div>
    <div class="bigside">
        <div class="container my-5" style="margin:22px;">
            <h1>Staff</h1>
            <a class="btn btn-primary" href="/kaffemariadb/staff-add-function.php" role="button">Add Staff</a>
    
        </div>
        <table class="table">
            <thead>
                <th>Staff ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Contact No.</th>
                <th>Position</th>
            </thead>
    
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database="kaffemariadb"; //name y=of your db
    
                //create connection
                $connection = new mysqli($servername, $username, $password, $database);
                
                if ($connection->connect_error){
                    die("connection failed: ". $$connection->connect_error);
                }
    
                //read all data inn the table
    
                $sql = "SELECT * FROM staff";
                $result= $connection->query($sql);
    
                if (!$result){
                    die("Invalid query: ".$connection->error);
                }
    
                while($row =$result->fetch_assoc()){
                    echo "<tr>
                    <td>".$row["staffID"]. "</td>
                    <td>".$row["staff_fname"]. "</td>
                    <td>".$row["staff_mname"]. "</td>
                    <td>".$row["staff_lname"]. "</td>
                    <td>".$row["staff_address"]. "</td>
                    <td>".$row["staff_contactno"]. "</td>
                    <td>".$row["staff_position"]. "</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/kaffemariadb/staff-edit-function.php?staffID=$row[staffID]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/kaffemariadb/staff-delete-function.php?staffID=$row[staffID]'>Delete</a>
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