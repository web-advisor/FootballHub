<?php
    include("functions.php");
    $error="";
    if($_GET["process"]=="login"){

        if(!$_POST["email"]){
            $error="An Email Or Username is required. ";
        }else if(!$_POST["password"]){
            $error="A Password is required. ";
        // }else if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)===false){
        //     $error= "Please enter a Valid email address";
        }
        if($error!=""){
            echo $error;
            exit();
        }

        // {
            // Signing in the user after checking
            // $query="SELECT * FROM `users` WHERE `email` = '".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
            $query="SELECT * FROM `users` WHERE `email` = '".mysqli_real_escape_string($link,$_POST['email'])."' OR `username`='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
            $result=mysqli_query($link,$query);
            $row=mysqli_fetch_assoc($result);
            if($row['password']==md5(md5($row['id']).$_POST['password'])){
                $_SESSION['id']=$row['id'];
                echo 1;
            }else{
                $error="Could not find that Username-Password Combination ! Please try Again !";
            }
        // }

        if($error!=""){
            echo $error;
            exit();
        }
    }


    if($_GET["process"]=="signup"){

        if(!$_POST["email"]){
            $error="An Email is required. ";
        }else if(!$_POST["username"]){
            $error="A Username is required. ";
        }else if(!$_POST["password"]){
            $error="A Password is required. ";
        }else if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)===false){
            $error= "Please enter a Valid email address";
        }
        if($error!=""){
            echo $error;
            exit();
        }

        // if($_POST["loginActive"]=="0"){
            // Checking if the Signing Up input email is already taken
            $query="SELECT * FROM `users` WHERE `email` = '".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
            $result=mysqli_query($link,$query);
            if(mysqli_num_rows($result)>0){
                $error="This Email id is already taken !";
            }else{
                // Siging up if no errors found
                $query="INSERT INTO `users` (`username`,`email`,`password`) VALUES ('".mysqli_real_escape_string($link,$_POST['username'])."','".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
                if(mysqli_query($link,$query)){
                    $_SESSION['id']=mysqli_insert_id($link);
                    // Password Hashing
                    $query="UPDATE `users` SET `password` = '".md5(md5($_SESSION['id']).$_POST['password'])."' WHERE `id`=".$_SESSION['id']." LIMIT 1";
                    mysqli_query($link,$query);
                    echo 1;
                }else{
                    $error="Couldn't Create User - Please try again later ";
                }
            }
            if($error!=""){
                echo $error;
                exit();
            }
        // }
    }

    if($_GET["process"]=="namecheck"){
            $query="SELECT * FROM `users` WHERE `username` = '".mysqli_real_escape_string($link,$_POST['username'])."' LIMIT 1";
            $result=mysqli_query($link,$query);
            if(mysqli_num_rows($result)>0){
                // $error="This Username is already taken !";
                echo 0;
            }else{               
                echo 1;
            }
    }

    if($_GET["process"]=="update"){
        $existCheck="SELECT `userid` FROM `details` WHERE `userId` = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
        if(mysqli_num_rows(mysqli_query($link,$existCheck))>0){
            $updatingInfo="UPDATE `details`
                SET `went`='".mysqli_real_escape_string($link,$_POST['went'])."',
                    `worked`='".mysqli_real_escape_string($link,$_POST['worked'])."',
                    `lives`='".mysqli_real_escape_string($link,$_POST['lives'])."',
                    `belong`='".mysqli_real_escape_string($link,$_POST['belong'])."'
                WHERE `userid`='".mysqli_real_escape_string($link,$_SESSION['id'])."'";
            if($resultInfo=mysqli_query($link,$updatingInfo)){
                echo 1; 
            }else{
                echo "Can't submit Info right now .. Please try again later. ";
            }
        }else{
            $insertingInfo="INSERT into `details` (`userid`,`went`,`worked`,`lives`,`belong`) 
            VALUES ( '".mysqli_real_escape_string($link,$_SESSION['id'])."',
                     '".mysqli_real_escape_string($link,$_POST['went'])."',
                     '".mysqli_real_escape_string($link,$_POST['worked'])."',
                     '".mysqli_real_escape_string($link,$_POST['lives'])."',
                     '".mysqli_real_escape_string($link,$_POST['belong'])."')";
            if(mysqli_query($link,$insertingInfo)){
                echo 1; 
            }else{
                echo "Can't submit Info right now .. Please try again later. ";
            }
        }
    }

    if($_GET["process"]=="post"){
        if(!$_POST['postContent']){
            echo "Your Post is Empty !";
        }else if(strlen($_POST['postContent'])>140){
            echo "Your Post is too long !";
        }else{
            $insertion="INSERT INTO `posts` (`post`,`userid`,`datetime`) VALUES ('".mysqli_real_escape_string($link,$_POST['postContent'])."',".mysqli_real_escape_string($link,$_SESSION['id']).",NOW())";
            if(mysqli_query($link,$insertion))
                echo 1;
        }
    }

    if($_GET["process"]=="toggleFollow"){
        $query="SELECT * FROM `isFollowing` WHERE `follower` = ".mysqli_real_escape_string($link,$_SESSION['id'])." AND `isFollowing`= ".mysqli_real_escape_string($link,$_POST['userid'])." LIMIT 1";
        $result=mysqli_query($link,$query);
        if(mysqli_num_rows($result)>0){
            // already following case 
            $row=mysqli_fetch_assoc($result);
            $deletion="DELETE FROM `isFollowing` WHERE `id` = ".mysqli_real_escape_string($link,$row['id'])." LIMIT 1";
            mysqli_query($link,$deletion);
            echo "1";
        }else{
            // Want to Follow Case
            $insertion="INSERT INTO `isFollowing` (`follower`,`isFollowing`) VALUES (".mysqli_real_escape_string($link,$_SESSION['id']).",".mysqli_real_escape_string($link,$_POST['userid']).")";
            mysqli_query($link,$insertion);
            echo "2";
        }    
    }


?>