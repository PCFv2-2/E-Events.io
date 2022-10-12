<?php
session_start();
require_once '../Required.php';
require_once '../BackEnd/FrontOffice/Points/pointsManager.php';
function startPage($title, $cssName, $jsScipt){
    ?>
    <html lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />

        <title> <?php echo $title;?> </title>
        <link rel="icon" type="image/x-icon" href="Assets/Images/logo_orange_no_text.ico">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="Assets/Styles/main.css" type="text/css"/>
        <link rel="stylesheet" href="Assets/Styles/headerAndFooter.css" type="text/css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script src="./Assets/Javascript/setDropdown.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <?php
            //stylesheet
            foreach($cssName as $stylesheet){?>
                <link rel="stylesheet" href="./Assets/Styles/<?php echo $stylesheet; ?>.css" type="text/css"/>
            <?php
            }
            //js script
            foreach($jsScipt as $script){?>
            <script src="<?php echo $script; ?>.js"></script>
            <?php
            }
        ?>
    </head>

    <body>
    <!-- Here is our main header that is used across all the pages of our website -->
    <header>
        <div class="container_top_bot container_top_font">
            <!-- This section gets pushed to the left side-->
            <div class="container_top_bot__section">
                <div class="container_top_bot__item">
                    <a href="homepage.php">
                        <img width="30" src="Assets/Images/logo_Black_No_Text.png" alt="logo du site E-Events.IO"/>
                    </a>
                </div>
                <div class="container_top_bot__item container_top_botButton"><a href="homepage.php">e-event.io</a></div>
            </div>
            <!-- This section gets pushed to the right side-->
            <div class="container_top_bot__section">
                <?php
                if (isset($_SESSION['roleId']) and $_SESSION['roleId'] == 4) {
                ?>
                    <div class="container_top_bot__item container_top_botButton"><span class="points-remaining"><?php echo getRemainPoints($_SESSION['userId']);?></span> points restant</div>
                <?php
                }
                ?>
                <div class="container_top_bot__item container_top_botButton"><a href="contact.php"><span class="material-symbols-outlined">mail</span></i></a></div>
                <?php
                if (!isset($_SESSION['userId'])) {
                ?>
                <div class="container_top_bot__item container_top_botButton"><a href="login.php"><span class="material-symbols-outlined">person</span></a></div>
                <?php
                }
                else {
                ?>
                <div class="container_top_bot__item container_top_botButton"><a onclick="setDropdown()"><span class="material-symbols-outlined">person</span></a></div>
                <?php
                }
                ?>
            </div>
        </div>
        <!-- Dropdown Menu !-->
        <ul class="dropdown">
            <li class="dropdown__li <?php if ($_SESSION['roleId'] != 4){?>underline<?php }?>"><a href="disconnect.php"><span class="material-symbols-outlined">logout</span> Se déconnecter</a></li>
            <?php
            if ($_SESSION['roleId'] == 1) {
            ?>
            <li class="dropdown__li underline"><a href="usersManager.php"><span class="material-symbols-outlined">settings</span> Gestion des utilisateurs</a></li>
            <li class="dropdown__li"><a><span class="material-symbols-outlined">settings</span> Gestion des campagnes</a></li>
                <?php
            }
            elseif ($_SESSION['roleId'] == 2) {
            ?>
            <li class="dropdown__li"><a href="juryVoteManager.php"><span class="material-symbols-outlined">how_to_vote</span> Vote pour un évènement</a></li>
            <?php
            }
            elseif ($_SESSION['roleId'] == 3) {
            ?>
            <li class="dropdown__li"><a href=""></a><span class="material-symbols-outlined">tune</span> Gestion de mon évènement</li>
            <?php
            }
            ?>
        </ul>
        <!-- !-->
    </header>
<?php
}?>
