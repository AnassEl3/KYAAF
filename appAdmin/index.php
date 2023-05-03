<?php
session_start();
$page = strtok($_SERVER["REQUEST_URI"], '?');;
if(isset($_SESSION['notification']))
{
    /*if(!empty($_SESSION['notification']))
        die($_SESSION['notification']);*/
}
require "controllers/router/pages.php";
