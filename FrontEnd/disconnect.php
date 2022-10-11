<?php
session_start();
unset($_SESSION['userId']);
unset($_SESSION['roleId']);
header('Location: ./homepage.php');