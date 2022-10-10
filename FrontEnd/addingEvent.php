<?php
include '../FrontEnd/header.php';
startPage("Ajouter un évènement",["form"],[]);
?>


    <!-- Here is our page's main content -->
    <main>
        <!-- It contains an article -->
        <article>
            <!-- Registration form -->
            <!-- subject, fist-name, last-name, email, details -->
            <form>
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
                            <input type="file" id="file" name="file">
                        </div>

                        <div id="form-right">
                            <label for="contact-title">Contact</label><br>

                            <select id="contact-title" name="contactType1" class="input2 form-spacing" required>
                                <option value="" selected disabled hidden>Choisir un type</option>
                                <option value="organizer">URL</option>
                                <option value="donator">email</option>
                                <option value="other">téléphone</option>
                            </select>
                            <input type="text" name="contact1" class="input" required><br>

                            <select name="contactType2" class="input2 form-spacing">
                                <option value="" selected disabled hidden>Choisir un type</option>
                                <option value="organizer">URL</option>
                                <option value="donator">email</option>
                                <option value="other">téléphone</option>
                            </select>
                            <input type="text" name="contact2" class="input"><br>

                            <select name="contactType3" class="input2 form-spacing">
                                <option value="" selected disabled hidden>Choisir un type</option>
                                <option value="organizer">URL</option>
                                <option value="donator">email</option>
                                <option value="other">téléphone</option>
                            </select>
                            <input type="text" name="contact3" class="input"><br>

                            <!-- Point Level -->
                            <label for="pointLevel">Palliers</label><br>
                            <input type="number" min="0" max="1000" id="pointLevel" name="pointLevelType1" class="input2 form-spacing" required>
                            <input type="text" name="pointLevel1" class="input" required><br>

                            <input type="number" min="0" max="1000" name="pointLevelType2" class="input2 form-spacing">
                            <input type="text" name="pointLevel2" class="input"><br>

                            <input type="number" min="0" max="1000" name="pointLevelType3" class="input2 form-spacing">
                            <input type="text" name="pointLevel3" class="input"><br>

                            <input type="number" min="0" max="1000" name="pointLevelType4" class="input2 form-spacing">
                            <input type="text" name="pointLevel4" class="input"><br>

                            <input type="number" min="0" max="1000" name="pointLevelType5" class="input2 form-spacing">
                            <input type="text" name="pointLevel5" class="input"><br>
                        </div>
                    </div>
                </div>
                <br>
                <input type="submit" value="Ajouter" class="input2" id="form-submit"/>
                <br>
            </form>
        </article>

    </main>

    <!-- And here is our main footer that is used across all the pages of our website -->


<?php
include '../FrontEnd/footer.php';
endPage();
?>