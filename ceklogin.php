<?php

require 'function.php';

if(isset($_SESSION['login'])){
    //sukses login
} else {
    //gagal login
    header('location:login.php');
}

?>