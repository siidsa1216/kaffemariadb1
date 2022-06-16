<?php

function check_login($connection)
{

    if(isset($SESSION['user_id']))
    {

        $id = $_SESSION['user_id'];
        $query = "select * from user where user_id = $id limit to 1";

        $result = mysqli_query($connection,$query);
        if(result && mysqli_num_rows($result) > 0)
        {

            $user_data = msqli_fetch_assoc($result);
            return $users_data;

        }
    }

    //redirect to login
    header("Location: login.php");
    die;

}

function random_num($length){
    $text = "";
    if($length < 5){
        $length = 5;
    }
    $len = rand(4,$length);
    for($i=0 ; $i < $len ; $i++){
        #code

        $text .= rand(0,9);
    }
    return $text;
}