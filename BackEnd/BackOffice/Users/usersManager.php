<?php
//require_once '../../../Required.php';
require_once Required::getMainDir() . '/BackEnd/Constants/keyConstants.php';
require_once Required::getMainDir() . '/BackEnd/Crypter/crypter.php';
/**
 * @param User $user
 * @return mixed|null
 * @throws Exception
 */
function getIdOfUser(User $user)
{
    $dbLogin = new DataBase(DataBaseEnum::LOGINS_READ);
    $listLogins = $dbLogin->selectQueryAndFetch('SELECT LOGIN FROM `USERS`');
    foreach ($listLogins as $value) {
        if ($user->getLogin() == safeDecrypt($value[0], KEY)) {
            $loginOfDatabase = $value[0];
            return $dbLogin->selectQueryAndFetch('SELECT USER_ID FROM `USERS` WHERE LOGIN = ?', array($loginOfDatabase), 's')[0][0];
        }
    }
    return null;
}


/**
 * @param User $user
 * @return void
 * @throws Exception
 */
function addUser(User $user)
{
    try {
        //Connection to Database
        $dbLogin = new DataBase(DataBaseEnum::LOGINS_WRITE);
        $dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);

        //User data
        $login = $user->getLogin();
        $password = $user->getPassword();
        $role = $user->getRole();
        $loginCrypt = safeEncrypt($login, KEY);
        $passwordHash = hash('sha256', $password);

        if (getIdOfUser($user) == null && $password != null) {
            // Execute queries
            $dbLogin->insertQueryAndFetch('INSERT INTO `USERS` (LOGIN, PASSWORD) VALUES (?,?)', array($loginCrypt, $passwordHash), 'ss');
            $user_id = getIdOfUser($user);
            $dbMain->insertQueryAndFetch('INSERT INTO `USERS` (USER_ID,ROLE_ID) VALUES (?,?)', array($user_id, $role), 'ii');
            echo 'BDD -> utilisateur ajouté';
        } else {
            // User already used or password is null or role is null
            throw new RuntimeException('USER_ID is not null or password is null or role is null');
        }
        $dbMain->close();
        $dbLogin->close();
    } catch (Exception $e) {
        throw new RuntimeException('Error during adding : ' . $e);
    }
}

/**
 * @param User $user
 * @return void
 */
function removeUser(User $user)
{
    try {
        //Connection to Database
        $dbLogin = new DataBase(DataBaseEnum::LOGINS_WRITE);
        $dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);

        $user_id = getIdOfUser($user);

        if ($user_id != null) {
            // Execute queries
            $dbLogin->insertQueryAndFetch('DELETE FROM `USERS` WHERE USER_ID = ?', array($user_id), 'i');
            $dbMain->insertQueryAndFetch('DELETE FROM `USERS` WHERE USER_ID = ?', array($user_id), 'i');
            echo "BDD -> utilisateur supprimé \n";
        } else {
            throw new RuntimeException('USER_IS is null');
        }
        $dbLogin->close();
        $dbMain->close();
    } catch (Exception $e) {
        throw new RuntimeException('Error during removing : ' . $e);
    }
}

/**
 * @param User $user
 * @return void
 */
function updateUser(User $user)
{
    try {
        //Connection to Database
        $dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);

        $role = $user->getRole();
        $user_id = getIdOfUser($user);

        if ($role != null) {
            //Execute query
            $dbMain->insertQueryAndFetch('UPDATE `USERS` SET ROLE_ID = ? WHERE USER_ID = ?', array($role, $user_id), 'ii');
            echo 'BDD -> utilisateur modifié';
        } else {
            throw new RuntimeException('ROLE is null');
        }
    } catch (Exception $e) {
        throw new RuntimeException('Error during removing : ' . $e);

    }
}