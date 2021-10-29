<main class="flexColumn flexCenter wrap">
    <h1>Mon compte</h1>

    <div class="flexRow width80">
        <div class="flexColumn width20">
            <a href="../../index.php?controller=user&action=account" class="border center">Mes informations</a>
            <a href="../../index.php?controller=user&action=statistic" class="border center">Mes statistiques</a>
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