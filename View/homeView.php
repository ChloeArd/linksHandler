<main class="flexRow flexCenter wrap">
    <?php
    if (isset($var['links'])) {
        foreach ($var['links'] as $link) {?>
                <form id="link" action="" method="post">
                    <input type="hidden" name="id" value="<?=$link->getId()?>">
                    <input type="hidden" name="href" value="<?=$link->getHref()?>">
                    <input type="hidden" name="target" value="<?=$link->getTarget()?>">
                    <input type="hidden" name="click" value="<?=$link->getClick()?>">
                    <div class="flexColumn width100">
                        <div id="containerPicture">
                            <img src="../assets/picture/photo.PNG" alt="<?=$link->getTitle()?>">
                        </div>
                        <a href="<?=$link->getHref()?>" id="containerLink" class="flexCenter">
                            <input id="graph1" class="buttonLink" type="submit" name="send" value="<?=$link->getName()?>">
                        </a>
                    </div>
                </form>
            <?php
            if (isset($_SESSION['id'])) {
                if ($_SESSION['role_fk'] != 2) {?>
                    <div class="flexColumn edit">
                        <a href="../index.php?controller=link&action=update&id=<?=$link->getId()?>"><i class="fas fa-pen-square"></i></a>
                        <a href="../index.php?controller=link&action=delete&id=<?=$link->getId()?>"><i class="fas fa-trash-alt"></i></a>
                    </div>
                    <?php
                }
            }
        }
    }
    ?>
</main>
