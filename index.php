<?php

    include("functions.php");

    // if($_GET['page']=="shop"){
    //     $thispage="shop";
    // }else
     if($_GET['page']=="post"){
        $thispage="post";
    // }else if($_GET['page']=="stats"){
    //     $thispage="stats";
    // }else if($_GET['page']=="profile"){
    //     $thispage="profile";
    // }else if($_GET['page']=="following"){
    //     $thispage="following";
    }else{
        $thispage="home";
    }


    include("Views/header.php");
    
    // if($_GET['page']=="shop"){
    //     include("Views/shop.php");
    // }else
     if($_GET['page']=="post"){
        include("Views/post.php");
    // }else if($_GET['page']=="stats"){
    //     include("Views/stats.php");
    // }else if($_GET['page']=="profile"){
    //     include("Views/profile.php");
    // }else if($_GET['page']=="following"){
    //     include("Views/following.php");
    }else{
        include("Views/home.php");
    }
    
    include("Views/footer.php");


?>

