<?php
require_once '../../../Required.php';

function eventIdVote($eventId){
    try {
        $dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);
        $userId = $_SESSION['userId'];
        $currentDate = date("Y-m-d");
        $seasonDate = $dbMain->selectQueryAndFetch('SELECT DATE_END FROM `SEASONS` WHERE SEASON_ID = (SELECT MAX(SEASON_ID) FROM `SEASONS`)')[0];
        $seasonId = $dbMain->selectQueryAndFetch('SELECT SEASON_ID FROM `SEASONS` WHERE SEASON_ID = (SELECT MAX(SEASON_ID) FROM `SEASONS`)')[0][0];

        if ($currentDate > $seasonDate[0]){
            if (!is_null($eventId)){
                $dbMain->insertQueryAndFetch('INSERT INTO `JURY_VOTE` (USER_ID,SEASON_ID,EVENT_ID) VALUES (?, ?, ?)', array($userId, $seasonId, (int)$eventId[0]), 'iii');
                header('Location: ../../../FrontEnd/juryVoteManager.php?vote');
            }
        } else {
            header('Location: ../../../FrontEnd/juryVoteManager.php?date');
        }
    } catch (Exception $e){
        throw new RuntimeException($e);
    }

}
