<?php
session_start();
require_once '../Required.php';
require_once '../BackEnd/Crypter/crypter.php';
require_once '../BackEnd/BackOffice/Users/usersManager.php';
require_once '../BackEnd/Classes/Enum/DataBaseEnum.php';

if (isset($_POST['username']) and isset($_POST['password'])){
    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    $dbLogin = new DataBase(DataBaseEnum::LOGINS_READ);
    $dbMain = new DataBase(DataBaseEnum::MAIN_READ);
    $idInDb = getIdOfUser(new User(-1, $username));

    if (is_null($idInDb)){
        header('Location: ./login.php?error=True');
    }else {
        if (hash('sha256',$password) == $dbLogin->selectQueryAndFetch('SELECT PASSWORD FROM USERS WHERE USER_ID = ?',array($idInDb),'i')[0][0]){
            $_SESSION['userId'] = $idInDb;
            $_SESSION['roleId'] = $dbMain->selectQueryAndFetch('SELECT ROLE_ID FROM USERS WHERE USER_ID = ?', array($idInDb),'i')[0][0];
            header('Location: ./homepage.php');
        }else {
            header('Location: ./login.php?error=True');
        }
    }
}