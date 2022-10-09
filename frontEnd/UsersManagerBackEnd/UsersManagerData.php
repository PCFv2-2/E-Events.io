<?php
/* DATA */
$dbLogin = new DataBase(DataBaseEnum::LOGINS_READ);
$dbMain = new DataBase(DataBaseEnum::MAIN_READ);
$usersLogin = $dbLogin->selectQueryAndFetch('SELECT * FROM USERS');
$usersMain = $dbMain->selectQueryAndFetch('SELECT * FROM USERS');
/* */