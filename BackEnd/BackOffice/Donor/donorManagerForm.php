<?php
require_once '../../../Required.php';
require_once '../../FrontOffice/Points/pointsManager.php';
session_start();

if (isset($_POST['points']) && $_POST['points'] <= getRemainPoints($_SESSION['userId'])){
    $dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);
    $date = new DateTime();
    $dbMain->insertQueryAndFetch('INSERT INTO `EVENTS_POINTS` (SPEND_DATE, USER_ID,EVENT_ID,NB_POINTS) VALUES (?,?,?,?)', array($date->format('Y-m-d H:i:s'), $_SESSION['userId'],$_GET['id'],$_POST['points']), 'siii');
    header('Location: ../../../FrontEnd/detailedEvent.php?id=' . $_GET['id'] . '&valid');
} else {
    header('Location: ../../../FrontEnd/detailedEvent.php?id=' . $_GET['id'] . '&error');
}

