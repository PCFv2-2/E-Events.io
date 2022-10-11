<?php
require_once '../../../Required.php';

$dbMain = new DataBase(DataBaseEnum::MAIN_READ);
$dateStart = $dbMain->selectQueryAndFetch('SELECT DATE_START FROM `SEASONS` WHERE SEASON_ID = (SELECT MAX(SEASON_ID) FROM `SEASONS`)')[0][0];
$dateEnd = $dbMain->selectQueryAndFetch('SELECT DATE_END FROM `SEASONS` WHERE SEASON_ID = (SELECT MAX(SEASON_ID) FROM `SEASONS`)')[0][0];
$seasonId = getdate();
$seasonId = $seasonId[year] . '-' . $seasonId[mon] . '-' . $seasonId[mday];

var_dump($dateStart);
var_dump($dateEnd);