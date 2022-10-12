<?php
include 'header.php';
if ($_SESSION['roleId'] != 3) {
    header('Location: ./errorPage1.html');
}


$modify = false;

if (isset($_GET['modify'])) {
    $modify = boolval($_GET['modify']);
    $dbMain = new DataBase(DataBaseEnum::MAIN_READ);
    $eventId = $dbMain->selectQueryAndFetch('SELECT EVENT_ID FROM EVENTS WHERE USER_ID=?', array($_SESSION['userId']), 'i')[0][0];
    $event = $dbMain->selectQueryAndFetch('SELECT * FROM EVENTS WHERE EVENT_ID=?', array($eventId), 'i')[0];
}

$title = $modify ? "Modifier mon évènement" : "Ajouter un évènement";
startPage($title, ["form"], []);
?>
startPage("Ajouter un évènement",["form"],[]);

//connect to database
$dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);
//get the current season
$data = $dbMain->selectQueryAndFetch("SELECT * FROM `SEASONS` WHERE `DATE_START`<= NOW() AND NOW() <= `DATE_END`");
$isSeason = (count($data)==0);

if($isSeason){?>
    <main>
    <!-- It contains an article -->
    <article>
        <p id="title">il n'est pas possible d'ajouter d'évènement, la saison est finie</p>
    </article>
    </main>
        <?php

}
else{

?>
    <!-- Here is our page's main content -->
    <main>
        <!-- It contains an article -->
        <article>
            <!-- Registration form -->
            <!-- subject, fist-name, last-name, email, details -->
            <form method="post" action="addingEventPost.php?modify=True" enctype="multipart/form-data" id="formAddingEvent">
                <div>
                    <h1 id="title">
                        <?php
                        echo $title;
                        ?>
                    </h1>
                    <div class="form-global">
                        <div id="form-left">
                            <label for="eventName">Nom de l'évènement</label><br>
                            <input type="text" id="eventName" name="eventName" class="input3 form-spacing" value="<?php
                            if ($modify) {
                                echo $event[3];
                            } ?>" required><br>

                            <label for="detailsEvent">Description</label><br>
                            <textarea id="detailsEvent" name="eventDescription" class="input3 form-spacing" rows="6"
                                      required>
                                <?php if ($modify) {
                                    echo $event[4];
                                } ?>
                            </textarea><br>

                            <label for="eventLocation">Lieu</label><br>
                            <input type="text" id="eventLocation" name="eventLocation" value="<?php
                            if ($modify) {
                                echo $event[6];
                            }
                            ?>" class="input3 form-spacing" required><br>

                            <label for="file">Image</label><br>
                            <input type="file" id="file" name="file[]" accept="image/png, image/jpeg, image/webp"
                                   multiple>
                        </div>

                        <div id="form-right">
                            <?php
                            if ($modify) {
                                $contacts = $dbMain->selectQueryAndFetch('SELECT * FROM EVENT_CONTACT WHERE EVENT_ID=?', array($eventId), 'i');
                                if (sizeof($contacts) == 3) {
                                    $contact1 = $contacts[0];
                                    $contact2 = $contacts[1];
                                    $contact3 = $contacts[2];
                                } else if (sizeof($contacts) == 2) {
                                    $contact1 = $contacts[0];
                                    $contact2 = $contacts[1];
                                } else if (sizeof($contacts) == 1) {
                                    $contact1 = $contacts[0];
                                }
                            }
                            ?>
                            <label for="contact-title">Contact</label><br>

                            <select id="contact-title" name="contactType1" class="input2 form-spacing" required>
                                <option value="none" <?php
                                if ($modify || !isset($contact1)) {
                                    echo "selected";
                                } ?>>Choisir un type
                                </option>
                                <option value="0" <?php
                                if ($modify && isset($contact1) && $contacts[0][1] == 0) {
                                    echo "selected";
                                } ?>>URL
                                </option>
                                <option value="2"<?php
                                if ($modify && isset($contact1) && $contacts[0][1] == 2) {
                                    echo "selected";
                                } ?>>Email
                                </option>
                                <option value="1"<?php
                                if ($modify && isset($contact1) && $contacts[0][1] == 1) {
                                    echo "selected";
                                } ?>>Téléphone
                                </option>
                            </select>
                            <input type="text" name="contact1" class="input" value="<?php
                            if ($modify && isset($contact1)) {
                                echo $contacts[0][2];
                            }?>"><br>

                            <select id="test" name="contactType2" class="input2 form-spacing">
                                <option value="none" <?php
                                if ($modify || !isset($contact2)) {
                                    echo "selected";
                                } ?>>Choisir un type
                                </option>
                                <option value="0" <?php
                                if ($modify && isset($contact2) && $contacts[1][1] == 0) {
                                    echo "selected";
                                } ?>>URL
                                </option>
                                <option value="2"<?php
                                if ($modify && isset($contact2) && $contacts[1][1] == 2) {
                                    echo "selected";
                                } ?>>Email
                                </option>
                                <option value="1"<?php
                                if ($modify && isset($contact2) && $contacts[1][1] == 1) {
                                    echo "selected";
                                } ?>>Téléphone
                                </option>
                            </select>
                            <input type="text" name="contact2" class="input" value="<?php
                            if ($modify && isset($contact2)) {
                                echo $contacts[1][2];
                            }?>"><br>

                            <select name="contactType3" class="input2 form-spacing">
                                <option value="none" <?php
                                if ($modify || !isset($contact3)) {
                                    echo "selected";
                                } ?>>Choisir un type
                                </option>
                                <option value="0" <?php
                                if ($modify && isset($contact3) && $contacts[2][1] == 0) {
                                    echo "selected";
                                } ?>>URL
                                </option>
                                <option value="2"<?php
                                if ($modify && isset($contact3) && $contacts[2][1] == 2) {
                                    echo "selected";
                                } ?>>Email
                                </option>
                                <option value="1"<?php
                                if ($modify && isset($contact3) && $contacts[2][1] == 1) {
                                    echo "selected";
                                } ?>>Téléphone
                                </option>
                            </select>
                            <input type="text" name="contact3" class="input" value="<?php
                            if ($modify && isset($contact3)) {
                                echo $contacts[2][2];
                            }?>" ><br>

                            <!-- Point Level -->
                            <?php
                            if ($modify) {
                                $goals = $dbMain->selectQueryAndFetch('SELECT * FROM EVENTS_GOALS WHERE EVENT_ID=?', array($eventId), 'i');
                            }
                            ?>
                            <label for="pointLevel">Paliers</label>
                            <button id="tooltip"><i class="fa fa-info-circle"></i><span id="tip">Veuillez saisir le nombre de points en plus nécessaires afin de passer au palier suivant</span>
                            </button>
                            <br>

                            <input type="number" min="1" max="1000" id="pointLevel" name="pointLevelType1"
                                   class="input2 form-spacing" value="0" required>
                            <input type="text" name="pointLevel1" class="input" required><br>

                            <input type="number" min="0" max="1000" name="pointLevelType2" class="input2 form-spacing"
                                   value="0">
                            <input type="text" name="pointLevel2" class="input"><br>

                            <input type="number" min="0" max="1000" name="pointLevelType3" class="input2 form-spacing"
                                   value="0">
                            <input type="text" name="pointLevel3" class="input"><br>

                            <input type="number" min="0" max="1000" name="pointLevelType4" class="input2 form-spacing"
                                   value="0">
                            <input type="text" name="pointLevel4" class="input"><br>

                            <input type="number" min="0" max="1000" name="pointLevelType5" class="input2 form-spacing"
                                   value="0">
                            <input type="text" name="pointLevel5" class="input"><br>
                        </div>
                    </div>
                </div>
                <br>
                <input type="submit" value="Ajouter" class="input2" id="form-submit"/>

                <!-- limits the number of files allowed -->
                <script>
                    $(function () {
                        $("input[type='submit']").click(function () {
                            var $fileUpload = $("input[type='file']");
                            if (parseInt($fileUpload.get(0).files.length) > 3) {
                                alert("You can only upload a maximum of 3 files");
                            }
                        });
                    });
                </script>
                <br>
            </form>
        </article>

    </main>

    <!-- And here is our main footer that is used across all the pages of our website -->


<?php
include 'footer.php';
endPage();
?>