<?php

if(isset($_SESSION['admin'])){
    if($_SESSION['admin'] == 1){
        require_once("main.php");
    }else{
        require_once("Login.php");
    }
}else{
    session_start();
    require_once("Registrar.php");
}

?>