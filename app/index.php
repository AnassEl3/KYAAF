<?php
    session_start();
    $page = strtok($_SERVER["REQUEST_URI"], '?');;
    
    require "controllers/routes/pages.php";
    require "controllers/routes/actions.php";
?> 
