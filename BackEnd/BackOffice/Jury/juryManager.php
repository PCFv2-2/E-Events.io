<?php
require_once '../../../Required.php';
require '../Users/usersManager.php';

function eventIdVote($eventId,User $user){
    try {
        $dbMain = new DataBase(DataBaseEnum::MAIN_READ);
        $juryId = getIdOfUser($user);
        $seasonId = null; //SESSION['season'] ?

        if (!is_null($eventId)){
            $dbMain->insertQueryAndFetch('INSERT INTO `JURY` (EVENT_ID,USER_ID,SEASON_ID) VALUES (?, ?, ?)', array($eventId, $juryId, $seasonId), 'iii');
        }
    } catch (Exception $e){
        throw new RuntimeException($e);
    }

}