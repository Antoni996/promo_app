<?php
/**
 * Created by PhpStorm.
 * User: antoni
 * Date: 20/05/18
 * Time: 22.11
 */
error_reporting(0);

session_start();

include_once("include/config.php");
include_once("include/OAuth.php");
include_once("include/TwitterAPIExchange.php");
//include_once("include/twitteroauth.php");


?>

<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">

    <title>Promo Around</title>
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

    <style>
        body, html {
            height: 100%;
        }
        body {
            font-family: Oswald;
        }
        .parallax {
            /* The image used */
            background-image: url('images/banner.jpg');

            /* Full height */
            height: 100%;

            /* Create the parallax scrolling effect */
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        b {
            font-size: larger;
        }
    </style>


</head>

<body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>


<!--SMOOTH EFFECT-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        // Add smooth scrolling to all links
        $("a").on('click', function(event) {

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    });
</script>

<?php

require 'Geo.php';
$geo = new Geo;
$geo->request('36.84.0.40');

$kotaSaya = $geo->city;
$kotaSayaCheck = strtolower($geo->city);

?>


<!--HERES THE NAVBAR-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
    <div class="container-fluid">
    <ul class="navbar-nav">
        <li class="navbar-brand">Promo Around</li>
        <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
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
<br><br>
<div class="parallax">
    <div class="centered" style="color: white">
        <center>
            <h3>LET'S START FIND SOME INTEREST PROMO<br><br></h3>
            <a href="#jumbotron"><img src="images/arrow_icon.gif" alt="arrow" width="15%"></a>
        </center>
    </div>

</div>
<div class="jumbotron text-center bg-primary" id="jumbotron">
    <img class="" src="images/logo.png" alt="logo app" width="20%">
    <h2 style="color: white">Selamat datang di <?php echo $kotaSaya; ?></h2>
</div>

    <div class="container">
        <div id="header1" class="row">

        </div>
        <div class="row">
            <div class="col-sm-3">
                <h2>Pilih Kategori</h2>
                <br>

                <form action="#jumbotron" method="POST">
                    <label for="cmbKind" class="my-1 mr-2">Jenis Promo</label>
                    <select id="cmbKind" class="form-control" name="Selected" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
                        <option value="Promo"<?php echo (isset($_POST['Selected']) && $_POST['Selected'] == 'Promo') ? 'selected="selected"' : ''; ?>>Semua promo</option>
                        <option value="Diskon"<?php echo (isset($_POST['Selected']) && $_POST['Selected'] == 'Diskon') ? 'selected="selected"' : ''; ?>>Diskon</option>
                        <option value="Gratis"<?php echo (isset($_POST['Selected']) && $_POST['Selected'] == 'Gratis') ? 'selected="selected"' : ''; ?>>Gratis</option>

                    </select>
                    <br>

                    <?php

                    if (isset($_POST['Selected'])) {
                        $makerValue = $_POST['Selected'];
                        
                    }
                    ?>



                    <label for="cmbLokasi" class="my-1 mr-2">Lokasi Promo</label>
                    <select id="cmbLokasi" class="form-control" name="LokasiSearch" onchange="document.getElementById('selected_text_lokasi').value=this.options[this.selectedIndex].text">
                        <option value="Semua"<?php echo (isset($_POST['LokasiSearch']) && $_POST['LokasiSearch'] == 'Semua') ? 'selected="selected"' : ''; ?>>Lokasi Saya</option>
                        <option value="Jakarta"<?php echo (isset($_POST['LokasiSearch']) && $_POST['LokasiSearch'] == 'Jakarta') ? 'selected="selected"' : ''; ?>>Jakarta</option>
                        <option value="Surabaya"<?php echo (isset($_POST['LokasiSearch']) && $_POST['LokasiSearch'] == 'Surabaya') ? 'selected="selected"' : ''; ?>>Surabaya</option>
                        <option value="Bandung"<?php echo (isset($_POST['LokasiSearch']) && $_POST['LokasiSearch'] == 'Bandung') ? 'selected="selected"' : ''; ?>>Bandung</option>
                        <option value="Semarang"<?php echo (isset($_POST['LokasiSearch']) && $_POST['LokasiSearch'] == 'Semarang') ? 'selected="selected"' : ''; ?>>Semarang</option>
                        <option value="Yogyakarta"<?php echo (isset($_POST['LokasiSearch']) && $_POST['LokasiSearch'] == 'Yogyakarta') ? 'selected="selected"' : ''; ?>>Yogyakarta</option>
                        <option value="Bali"<?php echo (isset($_POST['LokasiSearch']) && $_POST['LokasiSearch'] == 'Bali') ? 'selected="selected"' : ''; ?>>Bali</option>
                    </select>
                    <br>
                    <input type="hidden" name="selected_text_lokasi" id="selected_text_lokasi" value=""></input>
                    <input type="hidden" name="searchLokasi" value="Pilih Lokasi" class="btn btn-outline-primary"/>

                    <?php

                    if (isset($_POST['LokasiSearch'])) {
                        $makerLokasi = $_POST['LokasiSearch'];

                    }
                    ?>


                    <label for="cmbKategori" class="my-1 mr-2">Pilih Kategori</label>
                    <select id="cmbKategori" class="form-control" name="KategoriSearch" onchange="document.getElementById('selected_text_kategori').value=this.options[this.selectedIndex].text">
                        <option value="Kategori"<?php echo (isset($_POST['KategoriSearch']) && $_POST['KategoriSearch'] == '') ? 'selected="selected"' : ''; ?>>Semua Jenis</option>
                        <option value="Makanan"<?php echo (isset($_POST['KategoriSearch']) && $_POST['KategoriSearch'] == 'Makanan') ? 'selected="selected"' : ''; ?>>Makanan</option>
                        <option value="Fashion"<?php echo (isset($_POST['KategoriSearch']) && $_POST['KategoriSearch'] == 'Fashion') ? 'selected="selected"' : ''; ?>>Fashion</option>
                        <option value="Transportasi"<?php echo (isset($_POST['KategoriSearch']) && $_POST['KategoriSearch'] == 'Transportasi') ? 'selected="selected"' : ''; ?>>Transportasi</option>
                    </select>
                    <br>
                    <input type="hidden" name="selected_text_kategori" id="selected_text_lokasi" value=""></input>
                    <input type="hidden" name="searchKategori" value="Pilih Kategori" class="btn btn-outline-primary"/>

                    <?php

                    if (isset($_POST['KategoriSearch'])) {
                        $makerKategori = $_POST['KategoriSearch'];

                    }
                    ?>

                    <input type="hidden" name="selected_text" id="selected_text" value=""></input>
                    <br><input type="submit" name="search" value="Filter Kategori" class="btn btn-outline-primary"/>

                </form>
                <br>
            </div>


            <!-- ISI TWEETS -->

            <div class="col-sm-4">
                <h2 id="header-card">Daftar Promo</h2>

                </br>
                <div id="card" class="card" style="width: 400px">
                    <div class="card-body" style="font-family: 'Adobe Ming Std'">
                        <?php
                        //<3

                        if (isset($_POST['search'])) {
                            $makerValue = $_POST['Selected'];

                            $tweetsearch = "https://api.twitter.com/1.1/search/tweets.json";
                            $requestMethod = "GET";

                            $filterTweet = "-net24%20-sex%20-❤%20-bo%20-RT%20-avail%20-slot%20-camsex%20-booking%20-poker%20&lang=in&count=30"; //query berisi filter

                            $katMakanan = "makanan%20OR%20kitchen%20OR%20minuman%20OR%20kfc%20OR%20mcdonalds%20OR%20food%20OR%20sate%20OR%20starbucks%20OR%20lunch%20OR%20breakfast%20OR%20dinner%20OR%20food%20OR%20tea%20OR%20coffee%20OR%20jajan";

                            $katFashion = "sneakers%20OR%20sneaker%20OR%20shirt%20OR%20jaket%20OR%20bomber%20OR%20baju%20OR%20kaos%20OR%20jersey%20OR%20tas%20OR%20sepatu%20OR%20jas";

                            $katTransport = "kai%20OR%20grab%20OR%20gojek%20OR%20pesawat%20OR%20terbang%20OR%20kapal%20OR%20pesawat";

                            $twitter = new TwitterAPIExchange($settings);

                            //$jenis = $_POST['Selected']; //nilai dari jenis promo (all, diskon, gratis, kupon)


                            echo "<h4>Promo - " . $makerValue . " " . $makerKategori. "</h4>";


                            // $$$$$$$$$$$ LANJUT DISINI $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

                            if ($makerLokasi == "Jakarta")
                            {
                                echo "Promo berdasarkan kota ". $makerLokasi . "<br>";

                                if ($makerValue == "Promo")
                                {
                                    if ($makerKategori == "Makanan")
                                    {
                                    $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                    $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                        ->buildOauth($tweetsearch, $requestMethod)
                                        ->performRequest(), $assoc = TRUE);

                                    $counter = 0;
                                    foreach ($tweetresponse as $key) {
                                        foreach ($key as $t) {
                                            //$locationProfile = $t['user']['location'];
                                            echo '<br>';

                                            if ($counter < 2) {
                                                $userArray = $t['user'];
                                                $userArrayRt = $t['retweeted_status']['user'];

                                                $linkTweet = $t['entities']['urls'][0]['url'];
                                                $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                $locationProfile = $userArray['location'];
                                                $locationProfileCheck = strtolower($locationProfile);

                                                $locationProfileRt = $userArrayRt['location'];
                                                $locationProfileRt = strtolower($locationProfileRt);
                                                //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                //--MEDIA-->
                                                if ($t['entities']['media'] !== null) //berisi gambar
                                                {
                                                    echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                    echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                    $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                    if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                        preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                        echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                        echo "<br><br>";

                                                        if (strpos($t['text'], 'RT') !== false) {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<br>';
                                                            $rt = $t['text'];
                                                            $mediaRT = $t['entities']['media'][0]['url'];

                                                            if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                            }
                                                            echo "<hr>";
                                                        } else {
                                                            $mediaLink = $t['entities']['media'][0]['url'];
                                                            if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                            }
                                                            echo "<hr>";
                                                        }
                                                    }

                                                } else {
                                                    if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                    {
                                                        //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                        echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                        echo '<br>';
                                                        $rt = $t['retweeted_status'];
                                                        if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                        }
                                                        echo "<hr>";
                                                    } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                        echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                        echo '<br><br>';
                                                        echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                        echo "<hr>";
                                                    }
                                                }
                                            }
                                        }
                                        break;
                                        echo "<hr><hr>";
                                    } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    }
                                } //--Beda Filter----------------------------------------------------------------------------------------------------------->>
                                elseif ($makerValue == "Diskon")
                                {
                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20OR%20discount%20OR%20potongan%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    }
                                }
                                elseif ($makerValue == "Gratis")
                                {
                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20OR%20free%20beli%20%20purchase' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    }
                                }
                            }
                            // FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_

                            elseif ($makerLokasi == "Surabaya")
                            {
                                echo "Promo berdasarkan kota ". $makerLokasi . "<br>";

                                if ($makerValue == "Promo")
                                {

                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                } //--Beda Filter----------------------------------------------------------------------------------------------------------->>
                                elseif ($makerValue == "Diskon")
                                {

                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20OR%20discount%20OR%20potongan%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                }
                                elseif ($makerValue == "Gratis")
                                {
                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20OR%20free%20%20beli%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                }
                            }
                            // FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_

                            elseif ($makerLokasi == "Bandung")
                            {
                                echo "Promo berdasarkan kota ". $makerLokasi . "<br>";

                                if ($makerValue == "Promo")
                                {

                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                } //--Beda Filter----------------------------------------------------------------------------------------------------------->>
                                elseif ($makerValue == "Diskon")
                                {

                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20OR%20discount%20OR%20potongan%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                }
                                elseif ($makerValue == "Gratis")
                                {

                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20OR%20free%20%20beli%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                }
                            }
                            // FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_

                            elseif ($makerLokasi == "Semarang")
                            {
                                echo "Promo berdasarkan kota ". $makerLokasi . "<br>";

                                if ($makerValue == "Promo")
                                {

                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                } //--Beda Filter----------------------------------------------------------------------------------------------------------->>
                                elseif ($makerValue == "Diskon")
                                {

                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20OR%20discount%20OR%20potongan%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                }
                                elseif ($makerValue == "Gratis")
                                {

                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20OR%20free%20%20beli%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                }
                            }
                            // FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_

                            elseif ($makerLokasi == "Yogyakarta")
                            {
                                echo "Promo berdasarkan kota ". $makerLokasi . "<br>";

                                if ($makerValue == "Promo")
                                {
                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                } //--Beda Filter----------------------------------------------------------------------------------------------------------->>
                                elseif ($makerValue == "Diskon")
                                {

                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20OR%20discount%20OR%20potongan%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                }
                                elseif ($makerValue == "Gratis")
                                {

                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20OR%20free%20%20beli%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                }
                            }
                            // FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_

                            elseif ($makerLokasi == "Bali")
                            {
                                echo "Promo berdasarkan kota ". $makerLokasi . "<br>";

                                if ($makerValue == "Promo")
                                {

                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                } //--Beda Filter----------------------------------------------------------------------------------------------------------->>
                                elseif ($makerValue == "Diskon")
                                {

                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20OR%20discount%20OR%20potongan%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                }
                                elseif ($makerValue == "Gratis")
                                {
                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20OR%20free%20%20beli%20' . $makerLokasi . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $makerLokasi . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    } //<--end the game-->>

                                }
                            }
                            // FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_FilterLokasi_

                            else {
                                //  KALO ORANG GA PILIH LOKASI SAMA LOKASI OTOMATIS AMBIL DARI $KOTASAYA




                                echo "Promo berdasarkan kota sekarang, " . $kotaSaya . " :)<br>";
                                if ($makerValue == "Promo")
                                {
                                    if ($makerKategori == "Makanan")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $kotaSaya . '%20' . $katMakanan . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        } //<--end the game-->>
                                    }
                                    elseif ($makerKategori == "Fashion")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $kotaSaya . '%20' . $katFashion . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    elseif ($makerKategori == "Transportasi")
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $kotaSaya . '%20' . $katTransport . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }
                                    }
                                    else
                                    {
                                        $getfieldsearch = '?q=' . $makerValue . '%20' . $kotaSaya . '%20' . $filterTweet;

                                        $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                            ->buildOauth($tweetsearch, $requestMethod)
                                            ->performRequest(), $assoc = TRUE);

                                        $counter = 0;
                                        foreach ($tweetresponse as $key) {
                                            foreach ($key as $t) {
                                                //$locationProfile = $t['user']['location'];
                                                echo '<br>';

                                                if ($counter < 2) {
                                                    $userArray = $t['user'];
                                                    $userArrayRt = $t['retweeted_status']['user'];

                                                    $linkTweet = $t['entities']['urls'][0]['url'];
                                                    $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                    $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                    $locationProfile = $userArray['location'];
                                                    $locationProfileCheck = strtolower($locationProfile);

                                                    $locationProfileRt = $userArrayRt['location'];
                                                    $locationProfileRt = strtolower($locationProfileRt);
                                                    //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                    //--MEDIA-->
                                                    if ($t['entities']['media'] !== null) //berisi gambar
                                                    {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                        $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                        if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                            preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                            echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                            echo "<br><br>";

                                                            if (strpos($t['text'], 'RT') !== false) {
                                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                                echo '<br>';
                                                                $rt = $t['text'];
                                                                $mediaRT = $t['entities']['media'][0]['url'];

                                                                if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                                }
                                                                echo "<hr>";
                                                            } else {
                                                                $mediaLink = $t['entities']['media'][0]['url'];
                                                                if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                    echo '<br><br>';
                                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                                }
                                                                echo "<hr>";
                                                            }
                                                        }

                                                    } else {
                                                        if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                        {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                            echo '<br>';
                                                            $rt = $t['retweeted_status'];
                                                            if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                            }
                                                            echo "<hr>";
                                                        } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                            echo "<hr>";
                                                        }
                                                    }
                                                }
                                            }
                                            break;
                                            echo "<hr><hr>";
                                        }

                                    }
                                }//--Beda Filter----------------------------------------------------------------------------------------------------------->>
                                elseif ($makerValue == "Diskon")
                                {

                                    $getfieldsearch = '?q=' . $makerValue . '%20OR%20discount%20OR%20potongan%20' . $kotaSaya . '%20' . $filterTweet;

                                    $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                        ->buildOauth($tweetsearch, $requestMethod)
                                        ->performRequest(), $assoc = TRUE);

                                    $counter = 0;
                                    foreach ($tweetresponse as $key) {
                                        foreach ($key as $t) {
                                            //$locationProfile = $t['user']['location'];
                                            echo '<br>';

                                            if ($counter < 2) {
                                                $userArray = $t['user'];
                                                $userArrayRt = $t['retweeted_status']['user'];

                                                $linkTweet = $t['entities']['urls'][0]['url'];
                                                $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                $locationProfile = $userArray['location'];
                                                $locationProfileCheck = strtolower($locationProfile);

                                                $locationProfileRt = $userArrayRt['location'];
                                                $locationProfileRt = strtolower($locationProfileRt);
                                                //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                //--MEDIA-->
                                                if ($t['entities']['media'] !== null) //berisi gambar
                                                {
                                                    echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                    echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                    $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                    if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                        preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                        echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                        echo "<br><br>";

                                                        if (strpos($t['text'], 'RT') !== false) {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<br>';
                                                            $rt = $t['text'];
                                                            $mediaRT = $t['entities']['media'][0]['url'];

                                                            if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                            }
                                                            echo "<hr>";
                                                        } else {
                                                            $mediaLink = $t['entities']['media'][0]['url'];
                                                            if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                            }
                                                            echo "<hr>";
                                                        }
                                                    }

                                                } else {
                                                    if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                    {
                                                        //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                        echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                        echo '<br>';
                                                        $rt = $t['retweeted_status'];
                                                        if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                        }
                                                        echo "<hr>";
                                                    } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                        echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                        echo '<br><br>';
                                                        echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                        echo "<hr>";
                                                    }
                                                }
                                            }
                                        }
                                        break;
                                        echo "<hr><hr>";
                                    } //<--end the game-->>

                                }
                                elseif ($makerValue == "Gratis") {

                                    $getfieldsearch = '?q=' . $makerValue . '%20OR%20free%20%20beli%20' . $kotaSaya . '%20' . $filterTweet;

                                    $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                        ->buildOauth($tweetsearch, $requestMethod)
                                        ->performRequest(), $assoc = TRUE);

                                    $counter = 0;
                                    foreach ($tweetresponse as $key) {
                                        foreach ($key as $t) {
                                            //$locationProfile = $t['user']['location'];
                                            echo '<br>';

                                            if ($counter < 2) {
                                                $userArray = $t['user'];
                                                $userArrayRt = $t['retweeted_status']['user'];

                                                $linkTweet = $t['entities']['urls'][0]['url'];
                                                $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                                $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                                $locationProfile = $userArray['location'];
                                                $locationProfileCheck = strtolower($locationProfile);

                                                $locationProfileRt = $userArrayRt['location'];
                                                $locationProfileRt = strtolower($locationProfileRt);
                                                //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                                $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                                //--MEDIA-->
                                                if ($t['entities']['media'] !== null) //berisi gambar
                                                {
                                                    echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                    echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                    $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                    if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                        preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                        echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                        echo "<br><br>";

                                                        if (strpos($t['text'], 'RT') !== false) {
                                                            //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                            echo '<br>';
                                                            $rt = $t['text'];
                                                            $mediaRT = $t['entities']['media'][0]['url'];

                                                            if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                            }
                                                            echo "<hr>";
                                                        } else {
                                                            $mediaLink = $t['entities']['media'][0]['url'];
                                                            if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                                echo '<br><br>';
                                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                            }
                                                            echo "<hr>";
                                                        }
                                                    }

                                                }
                                                else {
                                                    if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                    {
                                                        //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                        echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                        echo '<br>';
                                                        $rt = $t['retweeted_status'];
                                                        if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                        }
                                                        echo "<hr>";
                                                    } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                        echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                        echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                        echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                        echo '<br><br>';
                                                        echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                        echo "<hr>";
                                                    }
                                                }
                                            }
                                        }
                                        break;
                                        echo "<hr><hr>";
                                    } //<--end the game-->>
                                }
                            }
                            // $$$$$$$$$$$ LANJUT DISINI $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

                        }
                        elseif (isset($_POST['brandSearch'])) {
                            if ($makerBrand == 'kfc') {

                                $tweetsearch = "https://api.twitter.com/1.1/search/tweets.json";
                                $requestMethod = "GET";

                                $filterTweet = "-net24%20-sex%20-❤%20-bo%20-RT%20-avail%20-slot%20-camsex%20-booking%20-poker%20&lang=in&count=30"; //query berisi filter

                                $twitter = new TwitterAPIExchange($settings);

                                $getfieldsearch = '?q=kfc%20' . $makerValue . '%20' . $filterTweet ;

                                $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                    ->buildOauth($tweetsearch, $requestMethod)
                                    ->performRequest(), $assoc = TRUE);

                                $counter = 0;
                                foreach ($tweetresponse as $key) {
                                    foreach ($key as $t) {
                                        //$locationProfile = $t['user']['location'];
                                        echo '<br>';
                                        echo 'Promo Brand';

                                        if ($counter < 2) {
                                            $userArray = $t['user'];
                                            $userArrayRt = $t['retweeted_status']['user'];

                                            $linkTweet = $t['entities']['urls'][0]['url'];
                                            $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                            $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                            $locationProfile = $userArray['location'];
                                            $locationProfileCheck = strtolower($locationProfile);

                                            $locationProfileRt = $userArrayRt['location'];
                                            $locationProfileRt = strtolower($locationProfileRt);
                                            //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                                            var_dump($t);
                                            //--MEDIA-->
                                            if ($t['entities']['media'] !== null) //berisi gambar
                                            {

                                                echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                                $mediaTweet = $t['entities']['media'][0]['media_url'];
                                                if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                    preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                    echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                    echo "<br><br>";

                                                    if (strpos($t['text'], 'RT') !== false) {
                                                        //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                        echo '<br>';
                                                        $rt = $t['text'];
                                                        $mediaRT = $t['entities']['media'][0]['url'];

                                                        if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                        }
                                                        echo "<hr>";
                                                    } else {
                                                        $mediaLink = $t['entities']['media'][0]['url'];
                                                        if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                            echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                            echo '<br><br>';
                                                            echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                        }
                                                        echo "<hr>";
                                                    }
                                                }

                                            }
                                            else {
                                                if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                                {
                                                    //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                    echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                    echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                    echo '<br>';
                                                    $rt = $t['retweeted_status'];
                                                    if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                        echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                        echo '<br><br>';
                                                        echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                    }
                                                    echo "<hr>";
                                                } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                    echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                    echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                    echo '<br><br>';
                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                    echo "<hr>";
                                                }
                                            }
                                        }
                                    }
                                    break;
                                    echo "<hr><hr>";
                                }
                            }

                        }

                        else {
                            //PROGRAM UTAMA ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------!>
                            $tweetsearch = "https://api.twitter.com/1.1/search/tweets.json";
                            $requestMethod = "GET";
                            $getfieldsearch = "q=promo%20OR%20diskon%20OR%20discount%20-sex%20-bo%20-RT%20-avail%20-slot%20-camsex%20-saya%20-booking%20-poker%20-include&lang=in&count=30";

                            //promo
                            $twitter = new TwitterAPIExchange($settings);
                            $tweetresponse = json_decode($twitter->setGetfield($getfieldsearch)
                                ->buildOauth($tweetsearch, $requestMethod)
                                ->performRequest(), $assoc = TRUE);

                            $counter = 0;

                            foreach ($tweetresponse as $key) {
                                foreach ($key as $t) {
                                    //$locationProfile = $t['user']['location'];
                                    echo '<br>';

                                    if ($counter < 2) {
                                        $userArray = $t['user'];
                                        $userArrayRt = $t['retweeted_status']['user'];

                                        $linkTweet = $t['entities']['urls'][0]['url'];
                                        $linkTweetRT = $t['retweeted_status']['entities']['urls'][0]['url'];
                                        $linkTweetRtMedia = $t['retweeted_status']['entities']['media'][0]['url'];

                                        $locationProfile = $userArray['location'];
                                        $locationProfileCheck = strtolower($locationProfile);

                                        $locationProfileRt = $userArrayRt['location'];
                                        $locationProfileRt = strtolower($locationProfileRt);
                                        //if (strpos($locationProfileCheck, $kotaSayaCheck) !== false)

                                        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

                                        //--MEDIA-->
                                        if ($t['entities']['media'] !== null) //berisi gambar
                                        {
                                            echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                            echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br>";

                                            $mediaTweet = $t['entities']['media'][0]['media_url'];
                                            if (preg_match($reg_exUrl, $mediaTweet, $url)) {
                                                preg_replace($reg_exUrl, "{$url[0]}", $mediaTweet);
                                                echo '<br><center><a href=' . $url[0] . ' target="_blank"><img id="myImg" class="img-thumbnail mx-auto d-block" src=' . $mediaTweet . ' alt="image tweet" width="80%"></img></a></center>';
                                                echo "<br><br>";

                                                if (strpos($t['text'], 'RT') !== false) {
                                                    //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                    echo '<br>';
                                                    $rt = $t['text'];
                                                    $mediaRT = $t['entities']['media'][0]['url'];

                                                    if (preg_match($reg_exUrl, $mediaRT, $url)) {
                                                        echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                        echo '<br><br>';
                                                        echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaRT);
                                                    }
                                                    echo "<hr>";
                                                } else {
                                                    $mediaLink = $t['entities']['media'][0]['url'];
                                                    if (preg_match($reg_exUrl, $mediaLink, $url)) {
                                                        echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                        echo '<br><br>';
                                                        echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $mediaLink);
                                                    }
                                                    echo "<hr>";
                                                }
                                            }

                                        } else {
                                            if (strpos($t['text'], 'RT') !== false) //teks & retweet
                                            {
                                                //echo '<b style="font-size: xx-large">Retweeted</b><br>';
                                                echo '<img src=' . $userArrayRt['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                echo " <span style='font-family: Oswald'><b>" . $userArrayRt['screen_name'] . "</b></span></br>";

                                                echo '<br>';
                                                $rt = $t['retweeted_status'];
                                                if (preg_match($reg_exUrl, $rt['text'], $url)) {
                                                    echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $rt['text']);
                                                    echo '<br><br>';
                                                    echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweetRT);
                                                }
                                                echo "<hr>";
                                            } elseif (preg_match($reg_exUrl, $t['text'], $url)) {
                                                echo '<img src=' . $userArray['profile_image_url'] . ' class="rounded-circle" alt="profile picture" width="15%"></img>';
                                                echo " <span style='font-family: Oswald'><b>" . $userArray['screen_name'] . "</b></span></br></br>";

                                                echo preg_replace($reg_exUrl, "<a href=" . $url[0] . " target='_blank'>{$url[0]}</a>", $t['text']);
                                                echo '<br><br>';
                                                echo preg_replace($reg_exUrl, "<center><a href=" . $url[0] . " class='btn btn-primary' target='_blank'>cek promo >></a></center>", $linkTweet);
                                                echo "<hr>";
                                            }
                                        }
                                    }
                                }
                                break;
                                echo "<hr><hr>";
                            }
                        }

                        ?>
                    </div>

                </div>
            </div>
            <div class="col-sm-3 offset-2">
                <h2>My Profile</h2>
                <?php
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


                // 1. profile pic and welcome text
                echo "<hr>";
                echo '<img class="img-thumbnail" src=' . $profilepic . '></img>';
                echo "&nbsp";
                echo $screenname;



                // 2. user information

                echo "<br><br>Name        : " . $usershowresponse['name'];
                echo "<br>Screen Name : " . $usershowresponse['screen_name'];
                echo "<br>Tweets      : " . $usershowresponse['statuses_count'];
                echo "<br><br>Info        : " . $usershowresponse['description'];


                }
                else
                {
                    header("location:index.php");
                    exit();
                }
                ?>

            </div>
        </div>
    </div>
</body>

</html>
