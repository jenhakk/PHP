<?php

session_start();
unset($_SESSION["user_ok"]);
unset($_SESSION["username"]);
unset($_SESSION["password"]);
session_destroy();
header("Location:userlogged.php");



?>