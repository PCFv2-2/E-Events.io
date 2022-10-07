<?php
require_once '../../Required.php';
require_once Required::getMainDir() . '/Constants/DataBaseConstants.php';
require_once Required::getMainDir() . '/Crypter/Crypter.php';
/**
 * @param User $user
 * @return void
 * @throws Exception
 */
function addUser(User $user)
{
    $key = '11111111111111111111111111111111';
    /* Connection */
    $dbLogin = new DataBase(DataBaseEnum::LOGINS_WRITE);
    $dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);
    /* User data */
    $login = $user->getLogin();
    $password = $user->getPassword();
    $role = $user->getRole();
    $loginsList = $dbLogin->selectQueryAndFetch('SELECT LOGIN FROM USERS',array(),'');

    $loginCrypt = safeEncrypt($login,$key);
    $passwordHash = hash('sha256',$password);

    foreach ($loginsList as $value){
        if ($login == safeDecrypt($value[0],$key)){
            throw new RuntimeException('Wrong login');
        }
    }
    //Verify that login is unique
    if (($password != null) && ($role != null)) {
        try {
            $queryLogin = 'INSERT INTO `USERS` (LOGIN, PASSWORD) VALUES (?,?)';
            $queryMain = 'INSERT INTO `USERS` (USER_ID,ROLE_ID) VALUES (?,?)';

            // Execute queries
            $dbLogin->insertQueryAndFetch($queryLogin,array($loginCrypt,$passwordHash),'ss');
            //GET id of USER in DATABASE login
            $id = $dbLogin->selectQueryAndFetch('SELECT USER_ID FROM `USERS` WHERE LOGIN = ?',array($loginCrypt),'s');
            $dbMain->insertQueryAndFetch($queryMain,array($id[0][0],$role),'ii');
            echo 'BDD -> utilisateur ajouté';
        } catch (Exception $e) {
            throw new RuntimeException('Error during adding');
        }
    } else {
        // User already used or password is null or role is null
        echo 'Error : le login est déjà utilisé ou le mot de passe / role est nul';
    }
    $dbMain->close();
    $dbLogin->close();
}

/**
 * @param User $user
 * @return void
 */
function removeUser(User $user)
{
    $key = '11111111111111111111111111111111';
    $dbLogin = new DataBase(DataBaseEnum::LOGINS_WRITE);
    $dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);

    // User data
    $login = $user->getLogin();
    $listLogins = $dbLogin->selectQueryAndFetch('SELECT LOGIN FROM `USERS`');
    $loginToDelete = null;
    foreach ($listLogins as $value){
        if ($login == safeDecrypt($value[0],$key)){
            $loginToDelete = $value[0];
        }
    }

    if ($login != null) {
        try {
            $queryLogin = 'DELETE FROM `USERS` WHERE LOGIN = ?';
            $queryMain = 'DELETE FROM `USERS` WHERE LOGIN = ?';

            // Execute queries
            $dbLogin->insertQueryAndFetch($queryLogin,array($loginToDelete),'s');
            $dbMain->insertQueryAndFetch($queryMain,array($loginToDelete),'s');
            echo 'BDD -> utilisateur supprimé';
        } catch (Exception $e) {
            throw new RuntimeException('Error during removing');
        }
    } else {
        // Login is incorrect
        echo 'Error : login incorrect';
    }
    $dbLogin->close();
    $dbMain->close();
}

/**
 * @param User $user
 * @return void
 */
function updateUser(User $user){
    $dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);

    $role = $user->getRole();
    $login = $user->getLogin();

    if ($role != null){
        try{
            $queryMain = 'UPDATE `USERS` SET ROLE_ID = ? WHERE LOGIN = ?';
            //Execute query
            $dbMain->insertQueryAndFetch($queryMain,array($role,safeEncrypt($login,$key),'is'));
        }
        catch (Exception $e){
            throw new RuntimeException('Error during updating');
        }
    }
    else {
        // Role is null
        echo 'Error : role is null';
    }


}

$key = '11111111111111111111111111111111';
$user = new User(-1,$login='Guillaume',$role=UsersRolesEnum::DONOR,$password='123456');
removeUser($user);

