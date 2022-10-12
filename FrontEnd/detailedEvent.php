<?php
require_once "header.php";
require_once "footer.php";
require_once '../Required.php';
require_once Required::getMainDir() . '/BackEnd/Constants/keyConstants.php';

if (!isset($_GET['id'])) {
    header("Location: errorPage1.html");
}

$id = intval($_GET["id"]);

$dbMain = new DataBase(DataBaseEnum::MAIN_READ);
$event = $dbMain->selectQueryAndFetch('SELECT * FROM EVENTS WHERE EVENT_ID=?', array($id), "i")[0];

startPage($event[3], array('detailedEvent'), array());
//$points = $_SESSION["nbPoints"];
$points = 3;

//connect to database
$dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);
//get the current season
$data = $dbMain->selectQueryAndFetch("SELECT * FROM `SEASONS` WHERE `DATE_START`<= NOW() AND NOW() <= `DATE_END`");
$isSeason = !(count($data)==0);

if($isSeason){
    $idSeason=$data[0][0];
    $data = $dbMain->selectQueryAndFetch("SELECT DISTINCT E.EVENT_ID, E.EVENT_NAME, I.IMAGE_PATH FROM `EVENTS` AS E JOIN `EVENTS_IMAGES` AS I ON E.EVENT_ID=I.EVENT_ID WHERE `SEASON_ID`<= ? ",array($idSeason),"i");
}


?>
<section class="detailed_event">
    <div class="detailed_event-left_panel">
        <h1 class="detailed_event-left_panel-title"><?php echo $event[3]; ?></h1>
        <img src="<?php
        $eventImage = $dbMain->selectQueryAndFetch('SELECT IMAGE_PATH FROM EVENTS_IMAGES WHERE EVENT_ID=?', array($id), 'i')[0][0];
        echo $eventImage;
        ?>" class="detailed_event-left_panel-image"
             alt="An image relative to the event"/>
        <p class="detailed_event-left_panel-description">
            <?php echo $event[4]; ?>
        </p>
    </div>
    <aside class="detailed_event-right_panel">
        <?php
        $points = $dbMain->selectQueryAndFetch('SELECT SUM(NB_POINTS) FROM EVENTS_POINTS WHERE EVENT_ID=?', array($id), 'i')[0][0];
        if (isset($_SESSION['roleId']) && $_SESSION['roleId'] == 4) {
            ?>
            <form class="detailed_event-right_panel-vote" method="post">
                <h2 class="vote-title">Voter pour l'évènement</h2>
                <div class="vote-donate_selector">
                    <input type="range" id="donate_selector_slider" min="1" max="<?php echo $points; ?>"
                           oninput="donate_selector_number.value=donate_selector_slider.value"/>
                    <input type="number" id="donate_selector_number" value="4" min="0" max="<?php
                    //TODO add a current value and a max value
                    ?>
                    15" oninput="donate_selector_slider.value=donate_selector_number.value"/>
                </div>
                <div class="vote-progress_bar">
                    <?php
                    $currentPoints = $dbMain->selectQueryAndFetch('SELECT SUM(NB_POINTS) FROM EVENTS_POINTS WHERE EVENT_ID=?', array($id), 'i')[0][0];
                    $maxPoints = $dbMain->selectQueryAndFetch('SELECT MAX(REQUIRE_NB_POINTS) FROM EVENTS_GOALS WHERE EVENT_ID=?', array($id), 'i')[0][0];
                    ?>
                    <div class="vote-progress_bar-value" style="width: <?php
                    $percentage = ($currentPoints / $maxPoints) * 100;
                    if ($percentage>100) {
                        echo 100;
                    }
                    if ($percentage<0) {
                        echo 0;
                    }
                    echo $percentage+5;
                    ?>%"><?php echo ($currentPoints / $maxPoints) * 100 . '%'; ?></div>
                </div>
                <p class="vote-text">
                    <?php
                    if ($currentPoints<$maxPoints) {
                        echo 'Encore ' . ($maxPoints - $currentPoints) . ' points avant d\'atteindre le niveau suivant';
                    }

                    else if ($currentPoints>$maxPoints) {
                        echo 'Le dernier palier à été atteint, mais vous pouvez quand même voter !';
                    }

                    echo '<br />Points totaux de l\'évènement : ' . $currentPoints;
                    ?>
                </p>
                <button type="submit" class="vote-submit_btn btn">Je vote</button>
            </form>
            <?php
        }
        ?>

        <div class="detailed_event-right_panel-steps">
            <h2 class="steps-title">les paliers</h2>
            <div class="steps-main">
                <!-- TODO Add a multiple handle range slider   -->
                <div class="steps-main-progress_numbers"></div>
                <div class="steps-main-text">
                    <p>Début</p>
                    <p>Etape 1</p>
                    <p>Etape 2</p>
                    <p>Etape 3</p>
                    <p>Etape 4</p>
                </div>
            </div>
            <!--<button class="steps-add_btn">+</button>-->
        </div>

    </aside>
</section>
<section class="other_events">
    <h1 class="other_events-title">D'autres évènements qui pourraient vous plaire</h1>
    <div class="other_events-cards">
        <?php
        foreach ($data as $otherevent) {
            ?>
            <a class="other_events-cards-card" href="detailedEvent.php?id=<?php echo $otherevent[0] ?>" style="background-image: url(<?php echo $otherevent[2] ?>); background-size: cover;">
                <div class="card-bottom">
                    <h3 class="card-bottom-title"><?php echo $otherevent[1]?></h3>
                    <i class="fa fa-arrow-right"></i>
                </div>
            </a>
            <?php
        }
        ?>
    </div>
</section>
<?php
endPage();
?>
