<?php
//$points = $_SESSION["nbPoints"];
$points = 15;
?>

<!-- Adding Stylesheet -->
<link rel="stylesheet" href="../assets/styles/DetailedEvent.css">
<link rel="stylesheet" href="../assets/styles/main.css">

<div class="detailed_event">
    <div class="detailed_event-left_panel">
        <h1 class="detailed_event-left_panel-title">tournoi smash au stade de france</h1>
        <img src="../assets/images/lorem-image.png" class="detailed_event-left_panel-image"
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
            <br/><br/>
            Praesent ut nisi nec elit lacinia blandit vel et neque. Quisque ultricies, sem non maximus eleifend, velit
            nibh dignissim est, et congue eros velit non nisl. Quisque ac sollicitudin ipsum. Cras nibh orci, eleifend
            at semper et, tempor sed metus. Sed sit amet mauris et sapien consectetur mollis eu ullamcorper lorem. Fusce
            nec ipsum nibh. Vivamus finibus ante ac commodo congue.
            <br/><br/>
            Nunc magna est, semper vitae ipsum imperdiet, pulvinar sollicitudin nisl. Nunc id nulla sit amet mi
            condimentum tincidunt vitae eget libero. Vivamus pharetra condimentum ultrices. Nulla sodales sem orci, in
            vestibulum ante rutrum non. Pellentesque a consequat lorem. Vivamus ut eros augue. Nullam pellentesque nulla
            nec lectus viverra pellentesque at quis erat. Fusce interdum blandit leo, vel auctor neque semper in. Sed
            elementum, est sed faucibus sagittis, mi neque faucibus ante, viverra tristique lectus nibh eu dui. Integer
            sed aliquet elit. Sed sollicitudin erat vulputate leo ultricies rutrum. Duis non tortor sit amet velit
            sagittis porttitor. Aliquam et mauris ligula. Phasellus condimentum imperdiet posuere.
            <br/><br/>
            Fusce vitae est sagittis, condimentum purus ac, tincidunt nisi. Fusce interdum pharetra tortor. Nulla semper
            odio eu ex viverra, vel semper quam dignissim. Donec ut molestie felis, feugiat tempor eros. Quisque nec
            posuere mauris. Maecenas sed pretium mauris, at dapibus leo. Aliquam finibus turpis id mauris dapibus
            elementum. Nullam.
        </p>
    </div>
    <div class="detailed_event-right_panel">
        <?php
        //TODO If user is a Donator, display this block
        ?>
        <form class="detailed_event-right_panel-vote" method="post">
            <h2 class="vote-title">Voter pour cet évènement ?</h2>
            <div class="vote-donate_selector">
                <div class="vote-donate_selector-slider_container">
                    <input type="range" id="donate_selector_slider" min="1" max="<?php echo $points; ?>"
                           oninput="donate_selector_number.value=donate_selector_slider.value"/>
                </div>
                <div class="vote-donate_selector-number_container">
                    <input type="number" id="donate_selector_number" value="4" min="0" max="15"
                           oninput="donate_selector_slider.value=donate_selector_number.value"/>
                </div>
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
            <button class="steps-add_btn">+</button>
        </div>

    </div>
</div>
