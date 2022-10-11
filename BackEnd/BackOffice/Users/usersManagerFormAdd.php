<?php
header("Location: ../../../FrontEnd/usersManager.php");
require_once '../../../Required.php';
require_once Required::getMainDir() . '/BackEnd/BackOffice/Users/usersManager.php';

$dbMain = new DataBase(DataBaseEnum::MAIN_READ);
$listRolesId = array();
foreach ($dbMain->selectQueryAndFetch('SELECT ROLE_NAME FROM `ROLES`') as $role_name){
    $listRolesId[] = $role_name[0];
}

$userLogin = $_POST['login'];
$userPassword = $_POST['password'];
$userRole = $_POST['role'];

if (!empty($userLogin) && !empty($userPassword) && !empty($userRole)){
    $userToAdd = new User(-1, $login = $userLogin, $role = array_search($_POST['role'],$listRolesId), $password = $userPassword);
    try {
        addUser($userToAdd);
    } catch (Exception $e) {
        echo $e;
    }
}
