<?php
header("Location: ../UsersManager.php");
require_once '../../Required.php';
require_once Required::getMainDir() . '/Classes/User/User.php';
require_once Required::getMainDir() . '/BackOffice/Users/UsersManager.php';

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
