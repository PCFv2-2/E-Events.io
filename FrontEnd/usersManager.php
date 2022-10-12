<?php
require_once '../Required.php';
require_once Required::getMainDir() . '/BackEnd/Constants/keyConstants.php';
require_once Required::getMainDir() . '/BackEnd/Crypter/crypter.php';
require_once Required::getMainDir() . '/BackEnd/FrontOffice/Password/passwordRandomizer.php';

$dbLogin = new DataBase(DataBaseEnum::LOGINS_READ);
$dbMain = new DataBase(DataBaseEnum::MAIN_READ);
$usersLogin = $dbLogin->selectQueryAndFetch('SELECT * FROM USERS');

include './header.php';
include './footer.php';

if ($_SESSION['roleId'] != 1) {
    header('Location: ./errorPage1.html');
}
startPage('Gestion des utilisateurs', array('usersManager'), array());
?>
<main class="user_manager">
    <h2>Gestion des utilisateurs</h2>
    <div class="container">
        <!-- Form 1 -->
        <form action="../BackEnd/BackOffice/Users/usersManagerForm.php" method="post" class="user_manager_all_users" onsubmit="return confirm('Voulez-vous vraiment enregistrer ces modifications dans la Base de données ?');">
            <span class="column_1">Utilisateur</span>
            <span class="column_2">Mot de passe</span>
            <span class="column_3">Rôle</span>
            <span class="column_4">Supprimer</span>
            <?php
            for ($i = 0; $i < sizeof($usersLogin); ++$i) {
                ?>
                <div style="<?php
                if ($i % 2 != 0) {
                    ?>
                        background-color: var(--light_primary);
                    <?php
                } else {
                    ?>
                        background-color: var(--light);
                    <?php
                }
                ?>" class="row_user">
                    <input type="text" readonly name="login[]"
                           value="<?php echo safeDecrypt($usersLogin[$i][1], KEY) ?>"/>
                    <input type="password" disabled placeholder="*********"/>
                    <select name="role[]">
                        <option value="">Rôle : <?php echo ($dbMain->selectQueryAndFetch('SELECT ROLE_NAME FROM `ROLES` INNER JOIN `USERS` ON `ROLES`.ROLE_ID = `USERS`.`ROLE_ID` WHERE USER_ID = ?',array($usersLogin[$i][0]),'i')[0][0]) ?></option>
                        <option value="Administrateur">Administrateur</option>
                        <option value="Membre du jury">Membre du jury</option>
                        <option value="Organisateur">Organisateur</option>
                        <option value="Donateur">Donateur</option>
                    </select>
                    <div class="modify_icons">
                        <input type="checkbox" name="delete[]"
                               value="<?php echo safeDecrypt($usersLogin[$i][1], KEY) ?>">
                        <span class="material-symbols-outlined">delete</span>
                    </div>
                </div>
                <?php
            }
            ?>
            <button class="submit_button" type="submit">
                <span class="material-symbols-outlined">done</span>
            </button>
        </form>
    </div>
    <!-- Form 2 -->
    <form action="../BackEnd/BackOffice/Users/usersManagerFormAdd.php" method="post" class="border_r row_user" onsubmit="return confirm('Voulez-vous vraiment enregistrer ces modifications dans la Base de données ?');">
        <input required type="text" name="login" placeholder="Michel"/>
        <input required type="text" name="password" value="<?php echo randomPassword(); ?>" placeholder="123456"/>
        <select name="role">
            <option value="Administrateur">Administrateur</option>
            <option value="Membre du jury">Membre du jury</option>
            <option value="Organisateur">Organisateur</option>
            <option value="Donateur">Donateur</option>
        </select>
        <button class="submit_button" type="submit">
            <span class="material-symbols-outlined">add</span>
        </button>
    </form>
</main>
<?php
endPage();
?>
