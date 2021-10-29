<?php
session_start();
// echo "Helllo ";
error_reporting(E_ALL ^ E_WARNING);

include("hash.php");
$link = mysqli_connect($host, $userName, $password, $dbName);
if (mysqli_connect_error()) {
    print_r(mysqli_connect_error());
    exit();
}
if (isset($_GET['process'])) {
    if ($_GET['process'] == "logout") {
        session_unset();
    }
}

function time_since($since)
{
    $chunks = array(
        array(60 * 60 * 24 * 365, 'year'),
        array(60 * 60 * 24 * 30, 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24, 'day'),
        array(60 * 60, 'hour'),
        array(60, 'min'),
        array(1, 'sec')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 ' . $name : "$count {$name}s";
    return $print;
}


function displayScores($type)
{
    global $apiToken;
    $timezone = "&tz=Asia/Kolkata";
    if ($type == "public") {
        $include = "&include=localTeam,visitorTeam";
        // $perpage=10-count($arrayLivescores['data']);
        // $limit=":limit($perpage|1)";
        // $sort=":order(starting_at|asc)";
        $jsonScoresToday = file_get_contents("https://soccer.sportmonks.com/api/v2.0/livescores?api_token=" . $apiToken . $include . $timezone . "&per_page=10");
        $arrayScoresToday = json_decode($jsonScoresToday, true);
        // print_r($arrayScoresToday);
        if (count($arrayScoresToday['data']) > 0) {
            // echo '<ul class="list-group list-group-horizontal">';
            for ($i = 0; $i < count($arrayScoresToday['data']); $i++) {
                if ($arrayScoresToday['data'][$i]['time']['status'] == "LIVE") {
                    $status = "LIVE " . $arrayScoresToday['data'][$i]['time']['minute'] . "'";
                    $localTeamScore = $arrayScoresToday['data'][$i]['scores']['localteam_score'];
                    $visitorTeamScore = $arrayScoresToday['data'][$i]['scores']['visitorteam_score'];
                } else if ($arrayScoresToday['data'][$i]['time']['status'] == "FT") {
                    $status = "Today " . $arrayScoresToday['data'][$i]['time']['status'];
                    $localTeamScore = $arrayScoresToday['data'][$i]['scores']['localteam_score'];
                    $visitorTeamScore = $arrayScoresToday['data'][$i]['scores']['visitorteam_score'];
                } else if ($arrayScoresToday['data'][$i]['time']['status'] == "HT") {
                    $status = "LIVE " . $arrayScoresToday['data'][$i]['time']['status'];
                    $localTeamScore = $arrayScoresToday['data'][$i]['scores']['localteam_score'];
                    $visitorTeamScore = $arrayScoresToday['data'][$i]['scores']['visitorteam_score'];
                } else if ($arrayScoresToday['data'][$i]['time']['status'] == "NS") {
                    $time = $arrayScoresToday['data'][$i]['time']['starting_at']['time'];
                    $status = "Today " . date("g:i A", strtotime($time));
                    $localTeamScore = "";
                    $visitorTeamScore = "";
                }
                // $clock=$arrayScoresToday['data'][$i]['time']['minute'];
                $localTeamCode = $arrayScoresToday['data'][$i]['localTeam']['data']['short_code'];
                $localTeamName = $arrayScoresToday['data'][$i]['localTeam']['data']['name'];
                $localTeamLogo = $arrayScoresToday['data'][$i]['localTeam']['data']['logo_path'];
                $visitorTeamCode = $arrayScoresToday['data'][$i]['visitorTeam']['data']['short_code'];
                $visitorTeamName = $arrayScoresToday['data'][$i]['visitorTeam']['data']['name'];
                $visitorTeamLogo = $arrayScoresToday['data'][$i]['visitorTeam']['data']['logo_path'];
                // echo "https://soccer.sportmonks.com/api/v2.0/livescores?api_token=".$apiToken.$include.$timezone."&per_page=10";
                echo '<div class="scores">                        
                                    <span style="float:right;font-weight:bolder;display:block;" class="black;">' . $status . '</span>
                                    <br>
                                    <div class="card-block text-center">
                                        <ul class="card-menu">                                        
                                            <li class="card-menu-item">
                                                <ul class="avatar-list">
                                                    <li class="avatar-list-item">
                                                        <img class="img-circle" src="' . $localTeamLogo . '">
                                                    </li>
                                                </ul> 
                                                <a href="#userModal" class="text-inherit" data-toggle="modal">
                                                <span class="brown">' . $localTeamName . '</span>
                                                <h6 class="my-0">' . $localTeamScore . '</h6>
                                                </a>
                                            </li>
                                            <li class="card-menu-item">
                                                <ul class="avatar-list">
                                                    <li class="avatar-list-item">
                                                        <img class="img-circle" src="' . $visitorTeamLogo . '">
                                                    </li>
                                                </ul>
                                                <a href="#userModal" class="text-inherit" data-toggle="modal">
                                                <span class="brown">' . $visitorTeamName . '</span>
                                                <h6 class="my-0">' . $visitorTeamScore . '</h6>
                                                </a>
                                            </li>
                                        </ul> 
                                    </div> 
                                </div>';
            }
            // echo "</ul>";
        }

        if (count($arrayScoresToday['data']) == 0 || count($arrayScoresToday['data']) < 10) {
            $include = "&include=localTeam,visitorTeam";
            $count = count($arrayScoresToday['data']);
            // echo "<div style='color:white;'>".$count."</div>";
            $required = (10 - $count);
            // echo "<div style='color:white;'>".$required."</div>";
            $perpage = "&per_page=" . $required;
            // echo "<div style='color:white;'>".$perpage."</div>";

            // $currentPage=$arrayDaterange['meta']['pagination']['current_page'];
            // echo "<div style='color:white;'>".$currentPage."Ruyt</div>";
            // if($currentPage>1){
            //     $currentPage=$currentPage-1;
            // }
            // echo "<div style='color:white;'>".$currentPage."</div>";
            if ($required == 10) {
                $page = "&page=4";
            } else if ($required == 9) {
                $page = "&page=6";
            } else if ($required == 8) {
                $page = "&page=7";
            } else if ($required == 7) {
                $page = "&page=8";
            } else if ($required == 6) {
                $page = "&page=9";
            } else if ($required == 5) {
                $page = "&page=11";
            } else if ($required == 4) {
                $page = "&page=14";
            } else if ($required == 3) {
                $page = "&page=18";
            } else if ($required == 2) {
                $page = "&page=26";
            } else if ($required == 1) {
                $page = "&page=53";
            }



            // echo "<div style='color:white;'>".$page."</div>";

            $yesterday = date("Y-m-d", strtotime("-1 days"));
            $fiveWeek = date('Y-m-d', strtotime("-5 week"));
            $jsonDateRange = file_get_contents("https://soccer.sportmonks.com/api/v2.0/fixtures/between/" . $fiveWeek . "/" . $yesterday . "?api_token=" . $apiToken . $include . $perpage . $page . $timezone);
            // echo "https://soccer.sportmonks.com/api/v2.0/fixtures/between/".$fiveWeek."/".$yesterday."?api_token=".$apiToken.$include.$perpage.$page.$timezone;

            // echo "<div style='color:white;'> https://soccer.sportmonks.com/api/v2.0/fixtures/between/".$fiveWeek."/".$yesterday."?api_token=".$apiToken.$include.$perpage.$page.$timezone."</div>";

            $arrayDaterange = json_decode($jsonDateRange, true);

            // echo '<ul class="list-group list-group-horizontal">';
            for ($i = 0; $i < count($arrayDaterange['data']); $i++) {
                if ($arrayDaterange['data'][$i]['time']['status'] == "FT") {
                    $date = $arrayDaterange['data'][$i]['time']['starting_at']['date'];
                    $datename = date("M jS,Y", strtotime($date));
                    $status = $datename . " FT";
                    // $clock=$arrayDaterange['data'][$i]['time']['minute'];
                    $localTeamCode = $arrayDaterange['data'][$i]['localTeam']['data']['short_code'];
                    $localTeamName = $arrayDaterange['data'][$i]['localTeam']['data']['name'];
                    $localTeamLogo = $arrayDaterange['data'][$i]['localTeam']['data']['logo_path'];
                    $visitorTeamCode = $arrayDaterange['data'][$i]['visitorTeam']['data']['short_code'];
                    $visitorTeamName = $arrayDaterange['data'][$i]['visitorTeam']['data']['name'];
                    $visitorTeamLogo = $arrayDaterange['data'][$i]['visitorTeam']['data']['logo_path'];
                    $localTeamScore = $arrayDaterange['data'][$i]['scores']['localteam_score'];
                    $visitorTeamScore = $arrayDaterange['data'][$i]['scores']['visitorteam_score'];
                    echo '<div class="scores">
                                        <span style="float:right;font-weight:bolder;display:block;" class="black;">' . $status . '</span>
                                        <br>
                                        <div class="card-block text-center">
                                            <ul class="card-menu">                                        
                                                <li class="card-menu-item">
                                                    <ul class="avatar-list">
                                                        <li class="avatar-list-item">
                                                            <img class="img-circle" src="' . $localTeamLogo . '">
                                                        </li>
                                                    </ul> 
                                                    <a href="#userModal" class="text-inherit" data-toggle="modal">
                                                    <span class="brown">' . $localTeamName . '</span>
                                                    <h6 class="my-0">' . $localTeamScore . '</h6>
                                                    </a>
                                                </li>
                                                <li class="card-menu-item">
                                                    <ul class="avatar-list">
                                                        <li class="avatar-list-item">
                                                            <img class="img-circle" src="' . $visitorTeamLogo . '">
                                                        </li>
                                                    </ul>
                                                    <a href="#userModal" class="text-inherit" data-toggle="modal">
                                                    <span class="brown">' . $visitorTeamName . '</span>
                                                    <h6 class="my-0">' . $visitorTeamScore . '</h6>
                                                    </a>
                                                </li>
                                            </ul> 
                                        </div> 
                                    </div>';
                }
            }
        }
    }
}





function displayNews($type)
{
    global $weatherApi;
    if ($type == "public") {
        $city="Delhi,india";
        $jsonWeather = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$city."&units=metric&appid=" . $weatherApi);
        $arrayWeather = json_decode($jsonWeather, true);
        if (count($arrayWeather["main"]) > 0) {
            $main = $arrayWeather["main"];
            $temp = $main["temp"];
            $feels_like = $main["feels_like"];
            $temp_min = $main["temp_min"];
            $temp_max = $main["temp_max"];
            $pressure = $main["pressure"];
            $humidity = $main["humidity"];
            $Weatherdesc=$arrayWeather["weather"][0]["description"];
            echo '
            <section class="wrapper">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="card-weather card text-white card-weather-has-bg card-has-bg click-col" style="background-image:url(\'https://source.unsplash.com/600x900/?tech,street\');">
                                <img class="card-weather-img card-img d-none" src="https://source.unsplash.com/600x900/?tech,street" alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                                <div class="card-weather-img-overlay card-img-overlay d-flex flex-column">
                                    <div class="card-weather-body card-body">
                                        <small class="card-weather-meta card-meta mb-2">Weather</small>
                                        <h4 class="card-weather-title mt-0 card-title">
                                            <a class="text-white" herf="#">'.$city.'</a>
                                        </h4>
                                        <small><i class="far fa-clock"></i> '.date('r',time()).'</small>
                                        <br />
                                        <br />
                                        <div class="card-text" style="font-size:200%;text-align:center">
                                            '.$temp.'&deg;C
                                        </div>  
                                        <div class="card-text" style="font-size:120%;text-align:center">
                                            MIN : '.$temp_min.'&deg;C | MAX : '.$temp_max.'&deg;C  
                                        </div>
                                        <div class="card-text" style="font-size:120%;text-align:center">
                                            Feels Like : '.$feels_like.'&deg;C
                                        </div>
                                        <div class="card-text" style="font-size:120%;text-align:center">
                                            Pressure : '.$pressure.'hPa | Humidity : '.$humidity.'%
                                        </div>
                                        <div class="card-text" style="font-size:150%;text-align:center">
                                            '.$Weatherdesc.'
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            ';
        }
    }

    /*
        global $newsApi;
        if($type=="public"){
            $jsonNews=file_get_contents("https://newsapi.org/v2/top-headlines?q=football&from=2021-04-20&sortBy=relevancy&language=en&category=sports&pageSize=10&apiKey=".$newsApi);
            $arrayNews=json_decode($jsonNews,true);
            // print_r($arrayNews);
            if(count($arrayNews['articles'])>0){
                for($i=0;$i<count($arrayNews['articles']);$i++){
                    if($arrayNews['articles'][$i]['author']==NULL){
                        $author="";
                    }else{
                        $author="By <b>".$arrayNews['articles'][$i]['author']."</b>";
                    }
                    $timePost=strtotime($arrayNews['articles'][$i]['publishedAt']);
                    $time=time();
                    $timePassed=$time-$timePost;
                    $content=$arrayNews['articles'][$i]['content'];
                    $urlToImage=$arrayNews['articles'][$i]['urlToImage'];
                    $description=$arrayNews['articles'][$i]['description'];
                    $url=$arrayNews['articles'][$i]['url'];
                    $title=$arrayNews['articles'][$i]['title'];
                    
                    echo '<div class="card mb-4 p-3">
                                <img class="card-img-top" src="'.$urlToImage.'" style="max-width:750;max-height:300;">
                                <div class="card-body m-3">
                                    <h3 class="card-title"> '.$title.' </h2>
                                    <p class="card-text brown"><b> '.$description.' </b></p>
                                    <p class="card-text">  '.$content.' </p>
                                    <a href="'.$url.'" class="btn btn-primary"> Read More </a>
                                </div>   
                                <div class="card-footer text muted"> 
                                    Posted '.time_since($timePassed).' ago '.$author.'
                                </div>
                          </div>';
                }
            }
        }
        */
}

//Search area
function displaySearch()
{
    echo '<form><div class="input-group">
        <input type="hidden" name="page" value="post">
        <input type="text" name="query" class="form-control" id="seaarch" size="100px" placeholder="Search Posts">  
   
       <div class="input-group-btn">
           <div>
               <button type="submit" class="btn">&#128269;</button>
           </div>      
       </div>
    </div>
   </form>';
}


// Posting Box
function displayPostBox()
{
    if (isset($_SESSION['id'])) {
        echo '         
                    <div id="postSuccess" class="alert alert-success">Your Post was Posted Successfully</div>
                    <div id="postFail" class="alert alert-danger"></div>
                    <textarea class="form-control" id="postContent"></textarea>
                    <div class="input-group-btn">
                        <button class="btn btn-primary" id="postButton">Post</button>
                    </div>
                        ';
    }
}


// displaying Post mechanism
function displayPosts($type)
{
    global $link;
    if ($type == "public") {
        $whereClause = "";
        // $whereClause="";
    } else if ($type == "isFollowing") {
        $whereClause = "";
        $query = "SELECT * FROM `isFollowing` WHERE `follower` = " . mysqli_real_escape_string($link, $_SESSION['id']);
        if ($result = mysqli_query($link, $query)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($whereClause == "") {
                        $whereClause = "WHERE";
                    } else {
                        $whereClause .= " OR";
                    }
                    $whereClause .= " userid=" . $row['isFollowing'];
                }
            }
        }
    } else if ($type == "yourPosts") {
        $whereClause = "WHERE userid=" . mysqli_real_escape_string($link, $_SESSION['id']);
    } else if ($type == "search") {
        echo "<p style='font-size:200%;color:white;'>Showing Results For <b>'" . mysqli_real_escape_string($link, $_GET['query']) . "'</b> :</p>";
        $whereClause = "WHERE `post` LIKE '%" . mysqli_real_escape_string($link, $_GET['query']) . "%'";
    } else if (is_numeric($type)) {
        $userQuery = "SELECT * FROM `users` WHERE id=" . mysqli_real_escape_string($link, $type) . " LIMIT 1";
        $userQueryResult = mysqli_query($link, $userQuery);
        $user = mysqli_fetch_assoc($userQueryResult);
        echo "<h2 style='color:#BC36B2;'>" . mysqli_real_escape_string($link, $user['username']) . "'s Posts</h2>";
        $whereClause = "WHERE userid=" . mysqli_real_escape_string($link, $type);
    }
    $query = "SELECT * FROM `posts` " . $whereClause . " ORDER BY `datetime` DESC LIMIT 10 ";
    if ($result = mysqli_query($link, $query)) {
        if (mysqli_num_rows($result) == 0) {
            echo '<div class="container post">
                               There are no posts to display !
                            </div>
                        ';
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                // User Info 
                $userQuery = "SELECT * FROM `users` WHERE id=" . mysqli_real_escape_string($link, $row['userid']) . " LIMIT 1";
                $userQueryResult = mysqli_query($link, $userQuery);
                $user = mysqli_fetch_assoc($userQueryResult);
                if ($user['id'] == $_SESSION['id'] && $type != "yourPosts") {
                    continue;
                }

                if ($type == "yourPosts") {
                    echo "<div class='media-body'>
                        <div class='media-heading'>
                            <small class='float-right text-muted'>" . time_since(time() - strtotime($row['datetime']) + 19800) . " ago</small>
                        </div>
                        <p class='brown'>" . $row['post'] . "</p> ";
                    echo "</div>";
                    continue;
                }
                echo "<li class='media list-group-item p-4'>
                        <img class='media-object d-flex align-self-start mr-3' src='assets/img/profile.jpg'>
                        <div class='media-body'>
                            <div class='media-heading'>
                                <small class='float-right text-muted'>" . time_since(time() - strtotime($row['datetime']) + 19800) . " ago</small>
                                <h6 style='color:blueviolet;'><a href='http://localhost/FootballHub/?page=post&userid='" . $user['id'] . "'>" . $user['username'] . "</a></h6>
                            </div>
                            <p class='brown'>" . $row['post'] . "</p> 
                             <p><a class='toggleFollow' data-userId='" . $row['userid'] . "'>";
                $isFollowingQuery = "SELECT * FROM `isFollowing` WHERE `follower` = " . mysqli_real_escape_string($link, $_SESSION['id']) . " AND `isFollowing`= " . mysqli_real_escape_string($link, $row['userid']) . " LIMIT 1";
                if ($isFollowingQueryResult = mysqli_query($link, $isFollowingQuery)) {
                    if (mysqli_num_rows($isFollowingQueryResult) > 0) {
                        echo '<button class="btn btn-outline-primary btn-sm">
                                    <span class="fas fa-user-minus"></span> Unfollow</button>';
                    } else {
                        echo '<button class="btn btn-outline-primary btn-sm">
                                    <span class="icon icon-add-user"></span> Follow</button>';
                    }
                }
                echo "</a></p>
                        </div>
                        </li> ";
            }
        }
    }
}

//  Suggestions 
function displayUser()
{
    global $link;

    $query = "SELECT * FROM `users` LIMIT 10";
    if ($result = mysqli_query($link, $query)) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['id'] == $_SESSION['id']) {
                continue;
            }
            echo '<li class="media mb-2">
                <img class="media-object d-flex align-self-start mr-3" src="assets/img/profile.jpg">
                <div class="media-body">
                  <strong><a style="font-size:1.2vw;" href="http://localhost/FootballHub/?page=post&userid=' . $row["id"] . '">' . $row["username"] . '</a></strong>
                </div>
              </li>';
        }
    }
}

function displaySponsor()
{
    echo '
        <div class="card mb-4 hidden-md-down">
          <div class="card-block">
            <h6 class="mb-3">Sponsored</h6>
            <div data-grid="images" data-target-height="150">
                <img class="media-object" data-width="640" data-height="640" data-action="zoom"
                src="assets/img/sponsor.jpg">
            </div>
            <p><strong>It might be time to visit Iceland.</strong> Iceland is so chill, and everything looks cool here.
              Also, we heard the people are pretty nice. What are you waiting for?</p>
            <a href="https://www.skyscanner.co.in/flights-to/is/cheap-flights-to-iceland.html" target="_blank"><button class="btn btn-outline-primary btn-sm">Buy a ticket</button></a>
          </div>
        </div>
        ';
}

   
     // $include="&include=";

    // Search by Leagues
    // $jsonLeagues=file_get_contents("https://soccer.sportmonks.com/api/v2.0/leagues?api_token=".$apiToken);
    // $arrayLeagues=json_decode($jsonLeagues,true);
    // print_r($arrayLeagues);
    
    // Search by Live Score
    // The livescores endpoint , will give you all the fixtures of the current day. 
    // In the livescores/now endpoint, the fixtures will be available 15 minutes before the match has started and 15 mins after it has ended.
    // Give by Timezone-->
    // $timezone="&tz=Asia/Kolkata";
    // $jsonLivescores=file_get_contents("https://soccer.sportmonks.com/api/v2.0/livescores/now?api_token=".$apiToken.$timezone);
    // $arrayLivescores=json_decode($jsonLivescores,true);
    // print_r($arrayLivescores);
    
    // Search by date Range
    // $currentDate=date("Y-m-d");
    // $oneWeek=date('Y-m-d', strtotime("-5 week"));
    // $jsonDateRange=file_get_contents("https://soccer.sportmonks.com/api/v2.0/fixtures/between/".$oneWeek."/".$currentDate."?api_token=".$apiToken."&per_page=10".$timezone);
    // $arrayDaterange=json_decode($jsonDateRange,true);
    // print_r($arrayDaterange);

    // Search by Date
    // Further data -> Searching with include ... object included must be listed in obj includes
    // $include.="localTeam,visitorTeam,events";
    // Search with Nested Includes. .. -> Possible only when element included can further include.. 
    // $include.="events.player"
    // FIltering out data -> giving the value(s) of parameters by which we want to filter out .. 
    // $season="&season=17141";
    // $leagues="&leagues=";
    // $leagues.="501";
    // $jsonDate=file_get_contents("https://soccer.sportmonks.com/api/v2.0/fixtures/date/2020-08-02?api_token=".$apiToken."&per_page=10".$timezone.$include.$leagues);
    // $arrayDate=json_decode($jsonDate,true);
    // print_r($arrayDate);

    // Search by Season 
    // $season="17141";
    // $include.="fixtures";
    // Limiting no. of API results ...
    // $limit=":limit(5|1)";
    // Sorting by starting time ascending..
    // $sort=":order(starting_at|asc)";
    // Sorting by starting time descending..
    // $sort=":order(starting_at|desc)";
    // $jsonSeason=file_get_contents("https://soccer.sportmonks.com/api/v2.0/seasons/".$season."?api_token=".$apiToken.$include.$limit.$sort);
    // $arraySeason=json_decode($jsonSeason,true);
    // print_r($arraySeason);

    // Season Schedule
    // $include.="rounds";
    // $jsonSchedule=file_get_contents("https://soccer.sportmonks.com/api/v2.0/seasons/17141?api_token=".$apiToken.$include);
    // $arraySchdule=json_decode($jsonSchedule,true);
    // print_r($arraySchdule);

    // Fixtures --- by Multiple IDS -> id of fixture
    // $jsonFixture=file_get_contents("https://soccer.sportmonks.com/api/v2.0/fixtures/multi/16475287,16475288?api_token=".$apiToken);
    // $arrayFixture=json_decode($jsonFixture,true);
    // print_r($arrayFixture);
    // Fixtures -- -by Team ID 
    // $teamId="53";
    // $jsonTeamFixture=file_get_contents("https://soccer.sportmonks.com/api/v2.0/fixtures/between/".$oneWeek."/".$currentDate."/".$teamId."?api_token=".$apiToken);
    // $arrayTeamFixture=json_decode($jsonTeamFixture,true);
    // print_r($arrayTeamFixture);

    // Stats -> From a MAtch ..
    // $include.="stats";
    // $matchID="16475287";
    // $jsonMatch=file_get_contents("https://soccer.sportmonks.com/api/v2.0/fixtures/".$matchID."?api_token=".$apiToken.$include);
    // $arrayMatch=json_decode($jsonMatch,true);
    // print_r($arrayMatch);
    // Stats -> Team
    // $teamId="53";'
    // $jsonTeam=file_get_contents("https://soccer.sportmonks.com/api/v2.0/teams/".$teamId."?api_token=".$apiToken.$include);
    // $arrayTeam=json_decode($jsonMatch,true);
    // print_r($arrayTeam);
    // Stats -> Player 
    // $playerID="31000";   
    // $jsonPlayer=file_get_contents("https://soccer.sportmonks.com/api/v2.0/players/".$playerID."?api_token=".$apiToken.$include);
    // $arrayPlayer=json_decode($jsonPlayer);
    // print_r($arrayPlayer);
    // Stats for the season -> Season ID
    
    // Standings --> In a Season 
    // $jsonStandings=file_get_contents("https://soccer.sportmonks.com/api/v2.0/standings/season/".$season."?api_token=".$apiToken);
    // $arrayStandings=json_decode($jsonStandings,true);
    // print_r($arrayStandings);

    // TopScorers in a Season
    // $include.="goalscorers.player,goalscorers.team";
    // $jsonTopScorers=file_get_contents("https://soccer.sportmonks.com/api/v2.0/topscorers/season/".$season."?api_token=".$apiToken.$include);
    // $arrayTopScorers=json_decode($jsonTopScorers,true);
    // print_r($arrayTopScorers);

    // Predictions in a Fixture 
    // $fixture="";
    // $jsonPredictions=file_get_contents("https://soccer.sportmonks.com/api/v2.0/predictions/probabilities/fixture/".$fixture."/?api_token=".$apiToken);
    // $arrayPredictions=json_decode($jsonPredictions,true);
    // print_r($arrayPredictions);
