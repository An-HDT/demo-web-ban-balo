<?php
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['nq']);
    header("location:../index.php?page=trangchu");
?>