<?php

session_start();
unset($_SESSION['login']);
unset($_SESSION['user']);
unset($_SESSION['type']);
unset($_SESSION['user_id']);
session_destroy();
header("Location: home.php");

?>