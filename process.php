<?php
/**
 * Created by PhpStorm.
 * User: antoni
 * Date: 18/05/18
 * Time: 21.23
 */

session_start();

include_once("include/config.php");
include_once("include/OAuth.php");
include_once("include/TwitterAPIExchange.php");
include_once("include/twitteroauth.php");

if (isset($_REQUEST['oauth_token']) && $_SESSION['token'] !== $_REQUEST['oauth_token'])
{
    session_destroy();
    header('location: ./main.php');
}
elseif (isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token'])
{
    $connection = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET, $_SESSION['token'], $_SESSION['token_secret']);
    $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

    if ($connection->http_code=='200')
    {
        $_SESSION['status'] = 'verified';
        $_SESSION['request_vars'] = $access_token;
        unset($_SESSION['token']);
        unset($_SESSION['token_secret']);
        header('Location: ./main.php');
    }
    else
    {
        die("error,try later");
    }
}
else
{
    if(isset($_GET["denied"]))
    {
        header('Location: ./main.php');
        die();
    }
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
    $request_token = $connection -> getRequestToken(OAUTH_CALLBACK);

    $_SESSION['token'] = $request_token['oauth_token'];
    $_SESSION['token_secret'] = $request_token['oauth_token_secret'];

    if($connection->http_code=='200')
    {
        $twitter_url = $connection->getAuthorizeURL(($request_token['oauth_token']));
        header('Location: '.$twitter_url);
    }
    else
    {
        die("error connecting to twitter");


    }
}
?>