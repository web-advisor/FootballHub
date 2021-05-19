<!-- This File contains the common header in all the pages . -->

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Amar Sinha">
    <meta name="description" content="One Place for all of Football Fandom's needs.">
    <meta name="keywords" content="Football,Live Scores,Recent Scores,Football Stats,Shop Football Jersey,Shop for Football jersey online,Shop Jersey,Barcelona,El Classico,Del Klasikar,Bayern Munich,Juventus,Messi VS Ronaldo">
    <meta name="robots" content="index,follow">

    <title>Football Hub</title>

    <link rel="icon" href="assets/img/iconic.jpg">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
    <link href="assets/css/toolkit.css" rel="stylesheet">
    <!-- <link href="dist/toolkit.min.css" rel="stylesheet"> -->
    <link href="assets/css/application.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="fontawesome/js/all.js"></script>
    <link href="assets/css/style.css" rel="stylesheet"> 
    
  </head>
  

<body class="with-top-navbar">
  <!-- Football Facts Implementation -->
 <!-- <div class="alert alert-warning alert-dismissible hidden-md-down" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <a class="alert-link" href="profile/index.html">Visit your profile!</a> Check your self, you aren't looking
          well.
        </div> -->

    <!-- <div class="growl" id="app-growl">FOOTBALL HUB </div> -->
    
    <nav class="navbar navbar-toggleable-sm fixed-top navbar-inverse bg-nav-svg roboto app-navbar container-content-middle" >
        <button
        class="navbar-toggler navbar-toggler-right hidden-md-up"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive"
        aria-controls="navbarResponsive"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    
        <a class="navbar-brand float-left" href="http://localhost/FootballHub/">
        <img src="assets/img/iconic.jpg" alt="brand">
        </a>

        <div class="h1 theme float-left" >
            footballHUB <i class="fa fa-futbol" aria-hidden="true"></i>
        </div>


        <ul id="#js-popoverContent" class="nav navbar-nav mr-0 hidden-sm-down" style="float:right;clear:none;">
            <li class="nav-item mt-1 mr-1">
            <a class="app-notifications nav-link" href="notifications/index.html">
                <span class="icon user-minus"></span>
            </a>
            </li>
           

            <form class="form-inline">
                <?php if(isset($_SESSION['id'])){ ?>
                    <button type="button" class="btn btn-md btn-pill btn-default" style="cursor:pointer;"><a href="?process=logout" style="text-decoration:none; font-weight:bolder; color:#000011;">Logout</a></button>
                <?php }else{   ?>
                    <button class=" btn btn-md btn-pill btn-default" style="cursor:pointer; font-weight:bolder; color:#000011;" data-toggle="modal" data-target="#staticBackdrop" type="button">Login/SignUp</button>
                <?php  }  ?>
            </form>
            <!-- <li class="nav-item ml-2">
            <button class="btn btn-default navbar-btn navbar-btn-avatar" data-toggle="popover">
                <img class="rounded-circle" src="assets/img/avatar-dhg.png">
            </button>
            </li> -->
        </ul>
    </nav>

    <nav class="navbar navbar-toggleable-sm navbar-inverse bg-nav-svg app-navbar container-content-middle" style="font-family:'Roboto', sans-serif;margin-top:40px;font-size:200%;font-weight:bold;">
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mr-auto">
            <!-- <li class="nav-item "  > -->
            <li class="nav-item <?php if($thispage=="home"){ $active="active"; echo $active; } ?> "  >
            <!-- <span class="sr-only">(current)</span>  -->
                <a class="nav-link" href="http://localhost/FootballHub/">Home &middot; </a>
            </li>
            <!-- <li class="nav-item hidden-md-up <?php if($thispage=="following"){ $active="active"; echo $active; } ?> ">
                <a class="nav-link" href="?page=following">Following  &middot; </a>
            </li> -->
            <li class="nav-item <?php if($thispage=="post"){ $active="active"; echo $active; } ?> ">
                <a class="nav-link" href="?page=post">Post  &middot;</a>
            </li>
            <!-- <li class="nav-item <?php if($thispage=="shop"){ $active="active"; echo $active; } ?> ">
                <a class="nav-link" href="?page=shop">Shop  &middot; </a>
            </li>
            <li class="nav-item <?php if($thispage=="stats"){ $active="active"; echo $active; } ?> ">
                <a class="nav-link" href="?page=stats">Statistics  &middot; </a>
            </li> -->
            <!-- <?php if(isset($_SESSION['id'])){ ?>
                <li class="nav-item <?php if($thispage=="profile"){ $active="active"; echo $active; } ?> ">
                    <a class="nav-link" href="?page=profile">Profile  &middot; </a>
                </li>
            <?php  }  ?>     -->
            <!-- <li class="nav-item hidden-md-up <?php if($thispage==""){ $active="active"; echo $active; } ?> ">
                <a class="nav-link" href="?page=">Notifications  &middot; </a>
            </li> -->
          
    
        </ul>
   
    </div>
    
  
    </nav>
     
