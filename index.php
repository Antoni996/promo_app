<?php
/**
 * Created by PhpStorm.
 * User: antoni
 * Date: 19/05/18
 * Time: 17.44
 */
error_reporting(0);

session_start();

include_once("include/config.php");
include_once("include/OAuth.php");
include_once("include/TwitterAPIExchange.php");
include_once("include/twitteroauth.php");

?>

<html>
<head>
    <title>Twitter API</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        body {
            background: url("images/sea.jpeg");
            background-size: 100%;
        }
        .container {
            font-family: Oswald;
        }
        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 500px;
        }

    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <img class="centered" src="images/logo.png" style="width: 45%" alt="logo app">
            </div>
            <div class="col-md-5 bg-white" style="height: 100%;opacity: 0.95">
                <div class="centered">
                    <h5 style="font-family: Oswald">Welcome to</h5>
                    <h2 style="font-family: Oswald">PROMO AROUND</h2>
                    <br><br>
                    <div id="content">
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

                                $usershow = "https://api.twitter.com/1.1/users/show.json";
                                //$profilebanner = "https://api.twitter.com/1.1/users/profile_banner.json";
                                $followerslist = "https://api.twitter.com/1.1/followers/list.json";
                                $tweets = "https://api.twitter.com/1.1/statuses/user_timeline.json";

                                $requestMethod = "GET";

                                $getfield = '?screen_name='.$screenname.'&count=10';


                                //user info
                                $twitter = new TwitterAPIExchange($settings);

                                /**
                                $twitter = $twitter -> setGetfield($getfield)
                                -> buildOauth($usershow,$requestMethod)
                                -> performRequest();

                                 */
                                $usershowresponse = json_decode( $twitter -> setGetfield($getfield)
                                    -> buildOauth($usershow,$requestMethod)
                                    -> performRequest(),$assoc=TRUE);

                                //list of tweets
                                $twitter = new TwitterAPIExchange($settings);

                                /**
                                $twitter = $twitter -> setGetfield($getfield)
                                -> buildOauth($usershow,$requestMethod)
                                -> performRequest();
                                 */
                                $tweetsresponse = json_decode($twitter -> setGetfield($getfield)
                                    -> buildOauth($tweets,$requestMethod)
                                    -> performRequest(),$assoc=TRUE);

                                $profilepic = $usershowresponse['profile_image_url'];

                                //DISPLAY INFO


                                // 1. profile pic and welcome text
                                echo "<hr>";
                                echo '<img class="img-thumbnail" src='.$profilepic.'></img>';
                                echo ' Welcome, '.$screenname;

                                //log out
                                echo ' <button type="button" class="btn btn-danger btn-sm float-right"><a href="logout.php" style="color: white">Logout</a></button>';
                                echo "<br><hr>";


                                // 2. user information
                                echo "<h4>User Information</h4></br>";
                                echo "<br>Name: ". $usershowresponse['name'];
                                echo "<br>ScreenName: ". $usershowresponse['screen_name'];
                                echo "<br>Location: ". $usershowresponse['location'];
                                echo "<br>Info: ". $usershowresponse['description'];
                                echo "<br>Followers: ". $usershowresponse['followers_count'];
                                echo "<br>Following: ". $usershowresponse['friends_count'];
                                echo "<br>Tweets: ". $usershowresponse['statuses_count'];
                                echo "<hr>";


                                echo '<button class="btn btn-block"><a href="main.php">Find Promo >></a></button>';
                                // 3. list of tweets
                                /**foreach ($tweetsresponse as $key)
                                {
                                $profilepic =$key['user']['profile_image_url'];
                                echo '<img src='.$profilepic.'></img>';

                                echo "Time And Date: ".$key['created_at']."</br>";
                                echo "Tweet: ".$key['text']."</br>";
                                echo "Screen Name: ".$key['user']['screen_name']."</br>";
                                echo "Retweet count: ".$key['retweet_count']."</br>";
                                echo "<hr>";
                                }
                                echo "<hr>";*/
                            }
                            else
                            {
                                echo '<br><br><center><a href="process.php"><img width="95%" src="images/loggedin.png"/></a></center>';
                                echo '<br><center><a href="https://twitter.com/i/flow/signup">Sign Up</a></center>';
                            }
                            ?>
                        </br></br>
                    </div>
                </div>
            </div>
        </div>
    </div>







</body>
</html>
