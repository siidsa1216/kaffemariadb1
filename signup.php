<?php
session_start();

    include("condb.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD']== "POST")
    {
        //something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {

            //save to db
            $user_id = random_num(20);
            $query = "INSERT INTO users (user_id,user_name,password) VALUES ('$user_id','$user_name','$password')";

            mysqli_query($connection, $query);

            header("Location: login.php");
            die;
        }
        else
        {
            echo "Please enter some valid information!";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sigup</title>
</head>
<body>
    <style type="text/css">
    body{
        background-color: #F3E3D3;
    }

    
    #text{
        height: 25px;
        border-radius: 5px;
        padding: 4px;
        border: none;
        width: 60%;
        color: black;
        text-align: left;
    }

    #button{
        padding: 10px;
        width: 100px;
        color:white;
        background-color: #EFCEAD;
        border: none;
    }

    #box{
        background: #8E5431;
        border: 1px solid rgba(0, 0, 0, 0.6);
        margin: auto;
        margin-top: 150px;
        width:300px;
        padding:20px;
        color: white;
        border-radius: 20px;
    }
    #signup{

    }
    </style>
    
    <div id="box">

        <form method="post">
            <div style="font-size: 20px;margin: 10px;color: white;text-align: center;">Signup</div>

            <p>Username: <input id="text" type="text" name="user_name"></p>
            <p>Password: <input id="text" type="password" name="password"></p>

            <input type="submit" value="Signup" style="background: none;color: white;border: none;margin-left: 120px"><br><br>

            <a href="login.php" style="color: white;margin-left: 100px;" white;="">Click to Login</a>
        </form>
    </div>
</body>
</html>