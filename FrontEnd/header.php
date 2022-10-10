<?php
function startPage($title, $cssName, $jsScipt){
    ?>
    <html lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />

        <title> <?php echo $title;?> </title>
        <link rel="icon" type="image/x-icon" href="../Assets/Images/logo_orange_no_text.ico">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../Assets/Styles/main.css" type="text/css"/>
        <link rel="stylesheet" href="../Assets/Styles/headerAndFooter.css" type="text/css"/>
        <?php
            //stylesheet
            foreach($cssName as $stylesheet){?>
                <link rel="stylesheet" href="../assets/styles/<?php echo $stylesheet; ?>.css" type="text/css"/>
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
                        <img width="30" src="../Assets/Images/logo_Black_No_Text.png" alt="logo du site E-Events.IO"/>
                    </a>
                </div>
                <div class="container_top_bot__item container_top_botButton"><a href="homepage.php">e-event.io</a></div>
            </div>
            <!-- This section gets pushed to the right side-->
            <div class="container_top_bot__section">
                <div class="container_top_bot__item container_top_botButton"><a href="contact.php"><i class="fa fa-envelope-o fa-lg"></i></a></div>
                <div class="container_top_bot__item container_top_botButton"><a href="connexion.php"><i class="fa fa-user-o fa-lg"></i></a></div>
            </div>
        </div>
    </header>



<?php
}?>
