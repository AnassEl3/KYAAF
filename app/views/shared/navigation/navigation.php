<?php
    if(isset($_SESSION["uid"])){
        include "views/shared/navigation/navigation2/navigation2.php";
    }else{
        include "views/shared/navigation/navigation1/navigation1.php";
    }
?>