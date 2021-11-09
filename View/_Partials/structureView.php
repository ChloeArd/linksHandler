<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <script src="https://kit.fontawesome.com/351e9300a0.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <header>
        <div id="menu" class="flexCenter flexRow">
            <div id="addLink">
                <?php
                if (isset($_SESSION['id'])) {?>
                    <a href="../../index.php?controller=link&action=add" class="flexCenter"><i class="fas fa-plus-square"></i>Ajouter un lien</a>
                    <?php
                }
                ?>
            </div>
            <div id="middle" class="flexCenter">
                <a href="../../">Accueil</a>
                <a href="../../index.php?controller=home&page=contact">Contact</a>
                <?php
                if (!isset($_SESSION['id'])) {?>
                    <a href="../../index.php?controller=home&page=connection">Connexion</a>
                    <a href="../../index.php?controller=home&page=registration">Inscription</a>
                <?php
                }
                ?>
            </div>

            <div id="account" class="flexCenter flexColumn">
                <?php
                if (isset($_SESSION['id'])) {?>
                    <a href="../../index.php?controller=user&action=account"><i class="fas fa-user-circle"></i></a>
                    <p class="grey"><?=$_SESSION['firstname']?></p>
                    <?php
                }
                ?>
            </div>
        </div>
    </header>

    <div id="modal" class='modal flexCenter'></div>
    <?= $html ?>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="../assets/js/app.js"></script>
</body>
</html>