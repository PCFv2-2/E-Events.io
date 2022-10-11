<?php
require_once "header.php";
require_once "footer.php";
startPage("Nom de l'évènement", array('detailedEvent'), array());
//$points = $_SESSION["nbPoints"];
$points = 15;
$listNamesOfEvents = array("Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement")
?>
<section class="detailed_event">
    <div class="detailed_event-left_panel">
        <h1 class="detailed_event-left_panel-title">tournoi smash au stade de france</h1>
        <img src="Assets/Images/lorem-image.png" class="detailed_event-left_panel-image"
             alt="An image relative to the event"/>
        <p class="detailed_event-left_panel-description">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin porttitor est et condimentum semper. Aenean
            cursus sed est non faucibus. Fusce vitae interdum tortor. Morbi posuere sed mi in pretium. Pellentesque id
            libero ac leo hendrerit eleifend vitae in arcu. Cras varius mi nisi, nec bibendum eros ullamcorper vitae.
            Nam commodo libero dolor, ac hendrerit dui ullamcorper ut. Nam sit amet tortor sit amet odio cursus
            hendrerit. Etiam tincidunt rhoncus quam, sagittis mollis tellus iaculis ut.
            <br/><br/>
            Nunc eget justo eget elit placerat rhoncus. Aliquam in tempor sem, et blandit magna. Praesent et augue et mi
            semper fringilla id sed sem. Quisque mollis tempor diam a aliquam. Fusce vestibulum ac ante in fermentum.
            Mauris mattis metus ac efficitur pellentesque. Aliquam nec porttitor ante. Orci varius natoque penatibus et
            magnis dis parturient montes, nascetur ridiculus mus. Nulla molestie, sapien eget sagittis pulvinar, est
            lacus vehicula purus, at ornare tortor elit eget est. Etiam quam orci, cursus quis porta ut, facilisis id
            libero. Phasellus venenatis ut tortor at blandit. Curabitur sed feugiat quam. Donec scelerisque, leo vel
            bibendum malesuada, enim neque feugiat orci, ac auctor quam turpis vel quam.
        </p>
    </div>
    <aside class="detailed_event-right_panel">
        <?php
        //TODO If user is a Donator, display this block
        ?>
        <form class="detailed_event-right_panel-vote" method="post">
            <h2 class="vote-title">Voter pour l'évènement</h2>
            <div class="vote-donate_selector">
                <input type="range" id="donate_selector_slider" min="1" max="<?php echo $points; ?>"
                       oninput="donate_selector_number.value=donate_selector_slider.value"/>
                <input type="number" id="donate_selector_number" value="4" min="0" max="15"
                       oninput="donate_selector_slider.value=donate_selector_number.value"/>
            </div>
            <div class="vote-progress_bar"></div>
            <p class="vote-text">Encore X points avant d'atteindre le niveau suivant</p>
            <button type="submit" class="vote-submit_btn btn">Je vote</button>
        </form>
        <?php
        // ENDIF
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
        foreach ($listNamesOfEvents as $eventName) {
            ?>
            <a class="other_events-cards-card" href="#">
                <div class="card-bottom">
                    <h3 class="card-bottom-title"><?php echo $eventName?></h3>
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
