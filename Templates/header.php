<?php
function start_page($title){
    ?>
    <html lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />

        <title> <?php echo $title;?> </title>
        <link rel="icon" type="image/x-icon" href="../Templates/Images/logo_orange_no_text.ico">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../Templates/Style/style.css" type="text/css"/>
    </head>

    <body>
    <!-- Here is our main header that is used across all the pages of our website -->

    <header>
        <div>
            <div class="container_top_bot container_top_font">
            <!-- This section gets pushed to the left side-->
            <div class="container_top_bot__section">
                <div class="container_top_bot__item">
                    <img width="30" src="../Templates/Images/Logo_Black_No_Text.png" alt="logo du site E-Events.IO"/>
                </div>
                <div class="container_top_bot__item container_top_botButton">e-event.io</div>
            </div>
            <!-- This section gets pushed to the right side-->
            <div class="container_top_bot__section">
                <div class="container_top_bot__item container_top_botButton"><a href="./homePage.php"><i class="fa fa-envelope-o fa-lg"></i></a></div>
                <div class="container_top_bot__item container_top_botButton"><a href="./contact.php"><i class="fa fa-user-o fa-lg"></i></a></div>
            </div>
        </div>
    </header>



<?php
}?>