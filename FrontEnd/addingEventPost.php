<?php
require_once '../Required.php';

$eventName = strip_tags($_POST['eventName']);
$eventDescription = strip_tags($_POST['eventDescription']);
$eventLocation = strip_tags($_POST['eventLocation']);

$postAddingEvent=array(array("eventName","s",true),array("eventDescription","s",true)
,array("eventLocation","s",true),array("contactType1","s",true),
    array("contact1","s",true),array("contactType2","s",false),array("contact2","s",false),
    array("contactType3","s",false),array("contact3","s",false),array("pointLevelType1","i", true),
    array("pointLevel1","s",true),array("pointLevelType2","i",false),array("pointLevel2","s",false),
    array("pointLevelType3","i",false),array("pointLevel3","s",false),array("pointLevelType4","i",false),array("pointLevel4","s",false),
    array("pointLevelType5","i",false),array("pointLevel5","s",false));
foreach($postAddingEvent as $value){
    if (!isset($_POST[$value[0]])) {
        header("Location: addingEvent.php");
        exit;
    }
}

if(count($_FILES["file"]["name"])<1 && count($_FILES["file"]["name"])>=3){
    header("Location: addingEvent.php");
    exit;
}
//connect to database
$dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);
//get the current season
$data = $dbMain->selectQueryAndFetch("SELECT * FROM `SEASONS` WHERE `DATE_START`<= NOW() AND NOW() <= `DATE_END`");
$idSeason=$data[0][0];
//get the current date
$today = date("Y-m-d H:i:s");
//insert data into table EVENTS
$values = array(76,$idSeason,$eventName, $eventDescription,$today,$eventLocation);
$types = "iissss";
$idEvent=$dbMain->insertQueryAndFetch('INSERT INTO `EVENTS` (USER_ID,SEASON_ID,EVENT_NAME,DESCRIPTION,DATE_ADD,PLACE) VALUES (?,?,?,?,?,?)',$values,$types);
//inserting contact(s)
for($i=1;$i<4;$i++){
    if($_POST["contactType".$i] != "none") {
        $values = array($idEvent,$_POST["contactType".$i],$_POST["contact".$i]);
        $types = "iis";
        $dbMain->insertQueryAndFetch('INSERT INTO `EVENT_CONTACT` (EVENT_ID,TYPE_CONTACT_ID,VALUE) VALUES (?,?,?)', $values, $types);
    }
}

//inserting goal(s)
for($i=1;$i<6;$i++){

    if($_POST["pointLevelType".$i] != "0") {
        $values = array($idEvent,0,$_POST["pointLevel".$i],$_POST["pointLevelType".$i]);
        $types = "iisi";
        $dbMain->insertQueryAndFetch('INSERT INTO `EVENTS_GOALS` (EVENT_ID,GOAL_ID,DESCRIPTION,REQUIRE_NB_POINTS) VALUES (?,?,?,?)', $values, $types);
    }
}

for($i=0;$i<count($_FILES["file"]["name"]);$i++) {
    $temp=explode('.',$_FILES["file"]["name"][$i]);
    $extension = end($temp);
    $uploadfile="Assets/Images/Event/img_event_".$idEvent."_".$i.".".$extension;
    if (move_uploaded_file($_FILES["file"]['tmp_name'][$i], $uploadfile)) {
        $values = array(0,$idEvent,$uploadfile);
        $types = "iis";
        $dbMain->insertQueryAndFetch('INSERT INTO `EVENTS_IMAGES` (IMAGE_ID,EVENT_ID,IMAGE_PATH) VALUES (?,?,?)', $values, $types);
    }
}

header("Location: detailedEvent.php?id=".$idEvent);
exit;