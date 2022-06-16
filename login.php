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

         //read from db
         
        $query = "select * from users where user_name = '$user_name' limit 1";

        $result = mysqli_query($connection, $query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {

                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['password'] === $password);
                {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: home.php");
                    die;
                }
            }
        }
        echo "Login failed. Please enter your correct password and username.";   
     }else
     {
         echo "Please enter some valid information!";
     }
 }
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
        color:black;
        background-color: white;
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
            <div style="font-size: 20px;margin: 10px;color: white;text-align: center;">Login</div>

            <p>Username: <input id="text" type="text" name="user_name"></p>
            <p>Password: <input id="text" type="password" name="password"></p>

            <input type="submit" value="Login" style="background: none;color: white;border: none;margin-left: 120px"><br><br>

            <a href="signup.php" style="color: white;margin-left: 100px;" white;="">Click to Signup</a>
        </form>
    </div>
</body>
</html>