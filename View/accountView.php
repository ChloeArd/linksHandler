<main class="flexColumn flexCenter wrap">
    <h1>Mon compte</h1>

    <div id="containerAccount" class="flexRow width80">
        <div class="flexColumn width20">
            <a href="../../index.php?controller=user&action=account" class="border center">Mes informations</a>
            <?php
            if ($_SESSION['role_fk'] == 1) {?>
                <a href="../../index.php?controller=user&action=statistic" class="border center">Mes statistiques</a>
            <?php
            }
            ?>
            <a href="../assets/php/disconnection.php" class="border center">Déconnexion</a>
        </div>

        <div class="border width80">
            <p class="info">Prénom</p>
            <p class="info2"><?=$_SESSION['firstname']?></p>
            <p class="info">Nom</p>
            <p class="info2"><?=$_SESSION['lastname']?></p>
            <p class="info">Email</p>
            <p class="info2"><?=$_SESSION['email']?></p>
        </div>
    </div>
</main>