<?php

session_start();
unset($_SESSION['users']);
unset($_SESSION['error']);
header("location:index.php");

?>
