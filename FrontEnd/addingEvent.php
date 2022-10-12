<?php
include '../FrontEnd/header.php';
if ($_SESSION['roleId'] != 3) {
    header('Location: ./errorPage1.html');
}
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
            <form method="post" action="addingEventPost.php" enctype="multipart/form-data" id="formAddingEvent">
                <div>
                    <p id="title">ajouter un évènement</p>
                    <div class="form-global">
                        <div id="form-left">
                            <label for="eventName">Nom de l'évènement</label><br>
                            <input type="text" id="eventName" name="eventName" class="input3 form-spacing" required><br>

                            <label for="detailsEvent">Description</label><br>
                            <textarea id="detailsEvent" name="eventDescription" class="input3 form-spacing" rows="6" required></textarea><br>

                            <label for="eventLocation">Lieu</label><br>
                            <input type="text" id="eventLocation" name="eventLocation" class="input3 form-spacing" required><br>

                            <label for="file">Image</label><br>
                            <input type="file" id="file" name="file[]" accept="image/png, image/jpeg" multiple>
                        </div>

                        <div id="form-right">
                            <label for="contact-title">Contact</label><br>

                            <select id="contact-title" name="contactType1" class="input2 form-spacing" required>
                                <option value="none" selected>Choisir un type</option>
                                <option value="0">URL</option>
                                <option value="2">email</option>
                                <option value="1">téléphone</option>
                            </select>
                            <input type="text" name="contact1" class="input" required><br>

                            <select id="test" name="contactType2" class="input2 form-spacing">
                                <option value="none" selected>Choisir un type</option>
                                <option value="0">URL</option>
                                <option value="2">email</option>
                                <option value="1">téléphone</option>
                            </select>
                            <input type="text" name="contact2" class="input"><br>

                            <select name="contactType3" class="input2 form-spacing">
                                <option value="none" selected>Choisir un type</option>
                                <option value="0">URL</option>
                                <option value="2">email</option>
                                <option value="1">téléphone</option>
                            </select>
                            <input type="text" name="contact3" class="input"><br>

                            <!-- Point Level -->
                            <label for="pointLevel">Palliers</label>
                            <button id="tooltip"><i class="fa fa-info-circle"></i><span id="tip">Veuillez saisir le nombre de points en plus nécessaires afin de passer au palier suivant</span></button><br>

                            <input type="number" min="1" max="1000" id="pointLevel" name="pointLevelType1" class="input2 form-spacing" value="0" required>
                            <input type="text" name="pointLevel1" class="input" required><br>

                            <input type="number" min="0" max="1000" name="pointLevelType2" class="input2 form-spacing" value="0">
                            <input type="text" name="pointLevel2" class="input"><br>

                            <input type="number" min="0" max="1000" name="pointLevelType3" class="input2 form-spacing" value="0">
                            <input type="text" name="pointLevel3" class="input"><br>

                            <input type="number" min="0" max="1000" name="pointLevelType4" class="input2 form-spacing" value="0">
                            <input type="text" name="pointLevel4" class="input"><br>

                            <input type="number" min="0" max="1000" name="pointLevelType5" class="input2 form-spacing" value="0">
                            <input type="text" name="pointLevel5" class="input"><br>
                        </div>
                    </div>
                </div>
                <br>
                <input type="submit" value="Ajouter" class="input2" id="form-submit"/>

                <!-- limits the number of files allowed -->
                <script>
                    $(function(){
                        $("input[type='submit']").click(function(){
                            var $fileUpload = $("input[type='file']");
                            if (parseInt($fileUpload.get(0).files.length)>3){
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
}
include '../FrontEnd/footer.php';
endPage();
?>