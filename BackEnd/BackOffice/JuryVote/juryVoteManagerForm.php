<?php
require_once '../../../Required.php';
require './juryVoteManager.php';

$dbMain = new DataBase(DataBaseEnum::MAIN_READ);
$currentSeason = $dbMain->selectQueryAndFetch('SELECT SEASON_ID FROM `SEASONS` WHERE SEASON_ID = (SELECT MAX(SEASON_ID) FROM `SEASONS`)')[0][0];
$userId = $_SESSION['userId'];

$juryHasVote = $dbMain->selectQueryAndFetch('SELECT EVENT_ID FROM `JURY_VOTE` WHERE SEASON_ID = ? AND USER_ID = ?',array($currentSeason,$userId),'ii');
if ($juryHasVote == null){
    eventIdVote($_POST['eventId']);
} else {
    header('Location: ../../../FrontEnd/juryVoteManager.php?error');
}
