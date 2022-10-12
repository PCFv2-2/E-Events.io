<?php
require_once '../../../Required.php';
require_once Required::getMainDir() . '/BackEnd/BackOffice/Seasons/seasonsManager.php';

$dateStart = $_POST['dateStart'];
$dateEnd = $_POST['dateEnd'];
$defaultPoints = $_POST['defaultPoints'];

if (!is_null($dateStart) && !is_null($dateEnd) && !is_null($defaultPoints)){
    $season = new Season($id = -1,$dateStart = new DateTime($dateStart),$dateEnd = new DateTime($dateEnd),$defaultPoints = $defaultPoints);
    addSeason($season);
}