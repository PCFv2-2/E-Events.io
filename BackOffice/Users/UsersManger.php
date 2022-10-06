<?php
require_once '../../Required.php';
require_once Required::getMainDir() . '/Constants/DataBaseConstants.php';
require_once Required::getMainDir() . '/Crypter/Crypter.php';
/**
 * @param User $user
 * @return void
 */
function addUser(User $user)
{
    $key = '11111111111111111111111111111111';
    /* Connection */
    $dbLogin = new DataBase(DataBaseEnum::LOGINS_WRITE);
    //$dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);
    /* User data */
    $login = $user->getLogin();
    $password = $user->getPassword();
    $role = $user->getRole();
    echo $login;
    $loginsList = $dbLogin->queryAndFetch('SELECT LOGIN FROM USERS');
    //Verify that login is unique
    if (!in_array($login, $loginsList) && ($password != null) && ($role != null)) {
        try {
            $queryLogin = "INSERT INTO USERS (LOGIN, PASSWORD) VALUES ($login,$password)";

            //GET id of USER in DATABASE login
            //$id = $dbLogin->queryAndFetch('SELECT USER_ID FROM USERS WHERE LOGIN = ' . safeEncrypt($login,$key));

            //$queryMain = 'INSERT INTO USERS (USER_ID,ROLE_ID) VALUES (' . $id . ',' . $role . ')';

            // Execute queries
            $dbLogin->queryAndFetch($queryLogin);
            //$dbMain->queryAndFetch($queryMain);
            echo 'BDD -> utilisateur ajouté';
        } catch (Exception $e) {
            throw new \http\Exception\RuntimeException('Error during adding');
        }
    } else {
        // User already used or password is null or role is null
        echo 'Error : le login est déjà utilisé ou le mot de passe / role est nul';
    }
    //$dbMain->close();
    $dbLogin->close();
}

/**
 * @param User $user
 * @return void
 */
function removeUser(User $user)
{
    $dbLogin = new DataBase(DataBaseEnum::LOGINS_WRITE);
    $dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);

    // User data
    $login = $user->getLogin();

    if ($login != null) {
        try {
            $queryLogin = 'DELETE FROM USERS WHERE LOGIN =' . safeEncrypt($login,$key) . '';
            $queryMain = 'DELETE FROM USERS WHERE LOGIN =' . safeEncrypt($login,$key) . '';

            // Execute queries
            $dbLogin->queryAndFetch($queryLogin);
            $dbMain->queryAndFetch($queryMain);
            echo 'BDD -> utilisateur supprimé';
        } catch (Exception $e) {
            throw new \http\Exception\RuntimeException('Error during removing');
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
            $queryMain = 'UPDATE USERS SET ROLE_ID =' . $role . 'WHERE LOGIN = ' . safeEncrypt($login,$key) . '';
            //Execute query
            $dbMain->queryAndFetch($queryMain);
        }
        catch (Exception $e){
            throw new \http\Exception\RuntimeException('Error during updating');
        }
    }
    else {
        // Role is null
        echo 'Error : role is null';
    }


}

$user = new User(-1,$login='guillaume',$role=UsersRolesEnum::DONOR,$password='1234');
addUser($user);

