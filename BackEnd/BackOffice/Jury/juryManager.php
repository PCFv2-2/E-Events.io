<?php
require_once '../../../Required.php';
require '../Users/usersManager.php';

function eventIdVote($eventId = 3){
    try {
        $dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);

        $userId = 77;
        $seasonDate = getdate();
        $seasonDate = $seasonDate[year] . '-' . $seasonDate[mon] . '-' . $seasonDate[mday];
        $dateStart = $dbMain->selectQueryAndFetch('SELECT DATE_START FROM `SEASONS` WHERE SEASON_ID = (SELECT MAX(SEASON_ID) FROM `SEASONS`)')[0][0];
        $dateEnd = $dbMain->selectQueryAndFetch('SELECT DATE_END FROM `SEASONS` WHERE SEASON_ID = (SELECT MAX(SEASON_ID) FROM `SEASONS`)')[0][0];
        $seasonId = $dbMain->selectQueryAndFetch('SELECT SEASON_ID FROM `SEASONS` WHERE SEASON_ID = (SELECT MAX(SEASON_ID) FROM `SEASONS`)')[0][0];
        echo $seasonId;

        if ($seasonDate >= $dateStart && $seasonDate <= $dateEnd){
            if (!is_null($eventId)){
                $dbMain->insertQueryAndFetch('INSERT INTO `JURY_VOTE` (USER_ID,SEASON_ID,EVENT_ID) VALUES (?, ?, ?)', array($userId, $seasonId, $eventId), 'iii');
            }
        }
    } catch (Exception $e){
        throw new RuntimeException($e);
    }

}
eventIdVote();