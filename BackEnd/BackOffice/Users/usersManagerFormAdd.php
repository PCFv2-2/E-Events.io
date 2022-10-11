<?php
header("Location: ../../../FrontEnd/usersManager.php");
require_once '../../../Required.php';
require_once Required::getMainDir() . '/BackEnd/BackOffice/Users/usersManager.php';

$userLogin = $_POST['login'];
$userPassword = $_POST['password'];
$userRole = $_POST['role'];

if (!empty($userLogin) && !empty($userPassword) && !empty($userRole)){
    $userToAdd = new User(-1, $login = $userLogin, $role = $userRole, $password = $userPassword);
    try {
        addUser($userToAdd);
    } catch (Exception $e) {
        echo $e;
    }
}
