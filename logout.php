<?php
/**
 * Created by PhpStorm.
 * User: antoni
 * Date: 19/05/18
 * Time: 20.15
 */

session_start();
session_destroy();
header('Location: ./index.php');
exit();


?>