<?php
session_start();
function boxMessage($message,$type,$messageButton,$events){
    ?>
    <form action="./UsersManager.php" method="GET" class="confirm-message">
        <h4 class="confirm-message__title"><?php echo $message ?></h4>
        <div>
            <?php foreach ($events as $event){
                ?>
                <p><?php echo $type . ' utilisateur : ' . $event?></p>
                <?php
            }?>
        </div>
        <span>
            <button type="submit" name="btnCancel" class="confirm_message__button">Annuler</button>
            <button type="submit" name="btnSave" class="confirm_message__button secondary-color"><?php echo $messageButton?></button>
        </span>
    </form>
    <?php
}