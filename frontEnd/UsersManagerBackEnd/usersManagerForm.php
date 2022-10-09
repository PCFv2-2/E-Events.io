<?php
require_once '../../Required.php';
require_once Required::getMainDir() . '/Classes/User/User.php';
require_once Required::getMainDir() . '/BackOffice/Users/UsersManager.php';
/*
if (!empty($_POST['delete'])) {
    echo "delete";
    $userToDelete = $_POST['delete'];
    foreach ($userToDelete as $user) {
        $userToDelete = new User(-1, $login = $user);
        //removeUser($userToDelete);
    }
} else {
    echo 'update';
    for ($i = 0; $i < sizeof($_POST['role']); ++$i) {
        if (!empty($_POST['role'][$i])) {
            $userToUpdate = new User(-1, $login = $_POST['login'][$i], $role = $_POST['role'][$i]);
            //updateUser($userToUpdate);
        }
    }
}*/

