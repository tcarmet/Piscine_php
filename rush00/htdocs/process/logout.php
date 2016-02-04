<?php
session_start();
unset($_SESSION['id_customer'], $_SESSION['civilite_customer'], $_SESSION['firstname_customer'], $_SESSION['name_customer'], $_SESSION['email_customer']);
header("Location: ./index.php");
die();
?>
