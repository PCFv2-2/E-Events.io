<?php
require_once '../Required.php';
require_once Required::getMainDir() . '/Constants/KeyConstants.php';
require_once Required::getMainDir() . '/Crypter/Crypter.php';
include './UsersManagerBackEnd/UsersManagerData.php';
include './header.php';
include './footer.php';
startPage('Gestion des utilisateurs', array('UsersManager'), array());
?>
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
<main class="user_manager">
    <h2>Gestion des utilisateurs</h2>
    <div class="container">
        <!-- Form 1 -->
        <form action="UsersManagerBackEnd/usersManagerForm.php" method="post" class="user_manager_all_users" onsubmit="return confirm('Voulez-vous vraiment enregistrer ces modifications dans la Base de données ?');">
            <span class="column_1">LOGIN</span>
            <span class="column_2">PASSWORD</span>
            <span class="column_3">ROLE_ID</span>
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
                    <input type="text" name="role[]" placeholder="<?php echo $usersMain[$i][0] ?>"/>
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
    <form action="UsersManagerBackEnd/usersManagerFormAdd.php" method="post" class="border_r row_user" onsubmit="return confirm('Voulez-vous vraiment enregistrer ces modifications dans la Base de données ?');">
        <input required type="text" name="login" placeholder="Michel"/>
        <input required type="password" name="password" placeholder="123456"/>
        <input required type="text" name="role" placeholder="1"/>
        <button class="submit_button" type="submit">
            <span class="material-symbols-outlined">add</span>
        </button>
    </form>
</main>
<?php
endPage();
?>
<script type="text/javascript">
    function sure(myVar) {
        if (confirm('Voulez vous supprimer?')) {
            window.location.href = "supprimer.php?Nom=" + myVar;
        }
    }
</script>
