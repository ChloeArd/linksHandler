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
                <?php
                if (!isset($_SESSION['id'])) {?>
                    <a href="../../index.php?controller=home&page=connection">Connexion</a>
                <?php
                }
                ?>
            </div>

            <div id="account">
                <?php
                if (isset($_SESSION['id'])) {?>
                    <a href="#"><i class="fas fa-user-circle"></i></a>
                <?php
                }
                ?>
            </div>
        </div>
    </header>

    <?= $html ?>

</body>
</html>