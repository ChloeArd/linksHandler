<main class="flexColumn flexCenter wrap">
    <h1>Mon compte</h1>

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

        <div class="border width80 flexColumn flexCenter">
            <p class="info width90">Prénom</p>
            <p class="info2 width90"><?=$_SESSION['firstname']?></p>
            <p class="info width90">Nom</p>
            <p class="info2 width90"><?=$_SESSION['lastname']?></p>
            <p class="info width90">Email</p>
            <p class="info2 width90"><?=$_SESSION['email']?></p>

            <a href="../../index.php?controller=user&action=update&id=<?=$_SESSION['id']?>" class="button button3 margTop15">Modifier mes informations</a>
            <a href="../../index.php?controller=user&action=updatePass&id=<?=$_SESSION['id']?>" class="button button3 margTop15">Changer mon mot de passe</a>
            <a href="../../index.php?controller=user&action=delete&id=<?=$_SESSION['id']?>" class="button button3 delete margTop15">Supprimer mon compte</a>

        </div>
    </div>
</main>