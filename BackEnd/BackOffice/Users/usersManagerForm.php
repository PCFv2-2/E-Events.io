<?php
header('Location: ../../../FrontEnd/usersManager.php');
require_once '../../../Required.php';
require_once Required::getMainDir() . '/BackEnd/BackOffice/Users/usersManager.php';

$dbMain = new DataBase(DataBaseEnum::MAIN_READ);
$listRolesId = array();
foreach ($dbMain->selectQueryAndFetch('SELECT ROLE_NAME FROM `ROLES`') as $role_name){
    $listRolesId[] = $role_name[0];
}

if (!empty($_POST['delete'])) {
    $userToDelete = $_POST['delete'];
    foreach ($userToDelete as $user) {
        $userToDelete = new User(-1, $login = $user);
        removeUser($userToDelete);
    }
} else {
    for ($i = 0; $i < sizeof($_POST['role']); ++$i) {
        if (!empty($_POST['role'][$i])) {
            $userToUpdate = new User(-1, $login = $_POST['login'][$i], $role = array_search($_POST['role'][$i],$listRolesId));
            updateUser($userToUpdate);
        }
    }
}

