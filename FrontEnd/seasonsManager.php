<?php
require_once '../Required.php';
require_once Required::getMainDir() . '/BackEnd/Constants/keyConstants.php';
require_once Required::getMainDir() . '/BackEnd/Crypter/crypter.php';

$dbMain = new DataBase(DataBaseEnum::MAIN_READ);
$seasons = $dbMain->selectQueryAndFetch('SELECT DATE_START, DATE_END, DEFAULT_POINTS FROM `SEASONS`');

include './header.php';
include './footer.php';

if ($_SESSION['roleId'] != 1) {
    header('Location: ./errorPage1.html');
}
startPage('Gestion des utilisateurs', array('seasonsManager'), array());
?>
<main class="user_manager">
    <h2>Gestion des campagnes</h2>
    <div class="container">
        <!-- Form 1 -->
        <form action="" method="" class="user_manager_all_users"
              onsubmit="return confirm('Voulez-vous vraiment enregistrer ces modifications dans la Base de données ?');">
            <span class="column_1">Date de début</span>
            <span class="column_2">Date de fin</span>
            <span class="column_3">Points des donateurs</span>
            <?php
            for ($i = 0; $i < sizeof($seasons); ++$i) {
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
                    <input readonly type="date" name="dateDeb[]"
                           value="<?php echo $seasons[$i][0] ?>"/>
                    <input readonly type="date" name="dateEnd[]"
                           value="<?php echo $seasons[$i][1] ?>"/>
                    <input readonly type="text" name="defaultPoints[]"
                           value="<?php echo $seasons[$i][2] ?>"/>
                </div>
                <?php
            }
            ?>
        </form>
    </div>
    <!-- Form 2 -->
    <form action="../BackEnd/BackOffice/Seasons/seasonsManagerForm.php" method="post" class="border_r row_user"
          onsubmit="return confirm('Voulez-vous vraiment enregistrer ces modifications dans la Base de données ?');">
        <input required type="date" name="dateStart" placeholder="2018-07-01"/>
        <input required type="date" name="dateEnd" placeholder="2018-02-01"/>
        <input required type="text" name="defaultPoints" placeholder="100"/>
        <button class="submit_button" type="submit">
            <span class="material-symbols-outlined">add</span>
        </button>
    </form>
</main>
<?php
if (isset($_GET['error'])){
    ?>
    <script>
        alert('L\'ajout de cette campagne n\'a pas fonctionné ! Vérifier vos dates !');
    </script>
    <?php
} else if (isset($_GET['valid'])) {
    ?>
    <script>
        alert('Votre campagne a bien été ajouté !');
    </script>
    <?php
}
endPage();
?>
