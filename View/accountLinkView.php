<main class="flexColumn flexCenter wrap">
    <h1>Mes liens</h1>

    <div id="containerAccount" class="flexRow width80">
        <div class="flexColumn width20">
            <a href="../../index.php?controller=user&action=account" class="border center">Mes informations</a>
            <a href="../../index.php?controller=link&action=myLink&id=<?=$_SESSION['id']?>" class="border center">Mes Liens</a>
            <?php
            if ($_SESSION['role_fk'] == 1) {?>
                <a href="../../index.php?controller=user&action=statistic" class="border center">Mes statistiques</a>
                <?php
            }
            ?>
            <a href="../assets/php/disconnection.php" id="disconnection" class="border center">Déconnexion</a>
        </div>

        <div id="myLink" class="border width80 flexRow flexCenter wrap">

        </div>
    </div>
</main>