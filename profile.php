<?php
/**
 * Created by PhpStorm.
 * User: antoni
 * Date: 04/06/18
 * Time: 18.25
 */
error_reporting(0);

session_start();

include_once("include/config.php");
include_once("include/OAuth.php");
include_once("include/TwitterAPIExchange.php");
include_once("include/twitteroauth.php");

?>

<html lang="en">
<head>
    <title>Profile Saya</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">

    <style>
        body {
            background: url("images/bg_twitter.jpeg");
            background-size: 100%;
            background-attachment: fixed;
            font-family: Oswald;

        }

    </style>

    <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] == 'verified')
    {
    $screenname = $_SESSION['request_vars']['screen_name'];
    $twitterid = $_SESSION['request_vars']['user_id'];
    $oauth_token = $_SESSION['request_vars']['oauth_token'];
    $oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];

    $settings = array(
        'oauth_access_token' => "1014129648152731648-mkoMJk7ezMrZo4jxcySyecc6miwe2B",
        'oauth_access_token_secret' => "fQnksiud59yLUmv7L7iJ3pu01Ezwx4DOCghZBNoiXh3E4",
        'consumer_key' => "hYLgEVQyoep6QcI3UdUqlEYPx",
        'consumer_secret' => "hSSbHfA985w5K47IKh0b9bwxQV1JpJZOMcmLgepH2GA7HVczoC"
    );
    ?>

</head>

<body>
<!--HERES THE NAVBAR-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="navbar-brand">Promo Around</li>
            <li class="nav-item">
                <a class="nav-link" href="main.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="help.php">Contact Us</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <form class="form-inline my-2 my-lg-0 navbar-right">
                <?php

                $usershow = "https://api.twitter.com/1.1/users/show.json";
                $requestMethod = "GET";
                $getfield = '?screen_name='.$screenname.'';
                $twitter = new TwitterAPIExchange($settings);
                $usershowresponse = json_decode($twitter -> setGetfield($getfield)
                    -> buildOauth($usershow,$requestMethod)
                    -> performRequest(),$assoc=TRUE);
                $profilepic = $usershowresponse['profile_image_url'];

                //My Profile
                echo "<hr>";
                echo '<img class="rounded-circle" src=' . $profilepic . ' alt="my profile" style="width: 14%"></img>&nbsp';
                echo '<div style="color: #f9f9f9"> Welcome, <i><b>' . $screenname .'</i></b></div>';

                //log out
                //echo '<a class="btn btn-outline-primary btn-sm" href="lagout.php">Logout</a>';
                //echo '<button type="button" class="btn btn-outline-danger"><a href="logout.php" >Logout</a></button>';
                echo "<br><hr><hr>";
                ?>
                &nbsp
                <button class=" btn btn-nav btn-danger my-2 my-sm-0 btn-sm"><a href="logout.php" style="color: #f9f9f9">Log Out</a></button>
            </form>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">

        <div class="col-md-10 offset-md-1">
            <br><br><br>
            <div class="card">
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['status']) && $_SESSION['status'] == 'verified') {
                        $screenname = $_SESSION['request_vars']['screen_name'];
                        $twitterid = $_SESSION['request_vars']['user_id'];
                        $oauth_token = $_SESSION['request_vars']['oauth_token'];
                        $oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];

                        $settings = array(
                            'oauth_access_token' => "1014129648152731648-mkoMJk7ezMrZo4jxcySyecc6miwe2B",
                            'oauth_access_token_secret' => "fQnksiud59yLUmv7L7iJ3pu01Ezwx4DOCghZBNoiXh3E4",
                            'consumer_key' => "hYLgEVQyoep6QcI3UdUqlEYPx",
                            'consumer_secret' => "hSSbHfA985w5K47IKh0b9bwxQV1JpJZOMcmLgepH2GA7HVczoC"
                        );

                        $usershow = "https://api.twitter.com/1.1/users/show.json";
                        //$profilebanner = "https://api.twitter.com/1.1/users/profile_banner.json";
                        $followerslist = "https://api.twitter.com/1.1/followers/list.json";
                        $tweets = "https://api.twitter.com/1.1/statuses/user_timeline.json";

                        $requestMethod = "GET";

                        $getfield = '?screen_name=' . $screenname ;


                        //user info
                        $twitter = new TwitterAPIExchange($settings);

                        /**
                         * $twitter = $twitter -> setGetfield($getfield)
                         * -> buildOauth($usershow,$requestMethod)
                         * -> performRequest();
                         */
                        $usershowresponse = json_decode($twitter->setGetfield($getfield)
                            ->buildOauth($usershow, $requestMethod)
                            ->performRequest(), $assoc = TRUE);

                        //list of tweets
                        $twitter = new TwitterAPIExchange($settings);

                        /**
                         * $twitter = $twitter -> setGetfield($getfield)
                         * -> buildOauth($usershow,$requestMethod)
                         * -> performRequest();
                         */
                        $tweetsresponse = json_decode($twitter->setGetfield($getfield)
                            ->buildOauth($tweets, $requestMethod)
                            ->performRequest(), $assoc = TRUE);

                        $profilepic = $usershowresponse['profile_image_url'];

                        //DISPLAY INFO
                        echo "<br><h1>Hello, " . $usershowresponse['name'] . " :)</h1>";

                        // 1. profile pic and welcome text
                        echo "<hr>";
                        echo '<img class="img-thumbnail" src=' . $profilepic . '></img>';
                        echo "&nbsp";
                        echo ' Welcome, ' . $screenname;

                        //log out
                        echo ' <button type="button" class="btn btn-danger float-right"><a href="logout.php" style="color: white">Logout</a></button>';
                        echo "<br><hr>";


                        // 2. user information
                        echo "<h4>User Information</h4>";
                        echo "<br>Name        : " . $usershowresponse['name'];
                        echo "<br>Screen Name : " . $usershowresponse['screen_name'];
                        echo "<br>Location    : " . $usershowresponse['location'];
                        echo "<br>Info        : " . $usershowresponse['description'];
                        echo "<br>Followers   : " . $usershowresponse['followers_count'];
                        echo "<br>Following   : " . $usershowresponse['friends_count'];
                        echo "<br>Tweets      : " . $usershowresponse['statuses_count'];
                        echo "<hr>";


                        echo '<a class="btn btn-primary btn-lg btn-block" href="main.php" role="button">Back to Promo >></a>';

                        // 3. list of tweets
                        foreach ($tweetsresponse as $key) {
                            $profilepic = $key['user']['profile_image_url'];

                            echo "<br><br><h2>My Tweet</h2>";
                            echo '<br><img class="img-thumbnail" src=' . $profilepic . '></img>';

                            echo "Time And Date: " . $key['created_at'] . "</br>";
                            echo "Tweet: " . $key['text'] . "</br>";
                            echo "Retweet count: " . $key['retweet_count'] . "</br>";
                            echo "<hr>";
                        }
                        echo "<hr>";
                    }
                    }
                    else
                    {
                        header("location:index.php");
                        exit();
                        //echo '<br><br><center><a href="process.php"><img width="%" src="images/loggedin.png"/></a></center>';

                    }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>