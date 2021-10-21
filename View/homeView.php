<main class="flexRow flexCenter wrap">
    <?php
    if (isset($var['links'])) {
        foreach ($var['links'] as $link) {?>
            <a href="<?=$link->getHref()?>" id="link" class="flexColumn" target="<?=$link->getTarget()?>">
                <div id="containerPicture">
                    <img src="<?=$link->getSrc()?>" alt="<?=$link->getTitle()?>">
                </div>
                <div id="containerLink" class="flexCenter">
                    <p><?=$link->getName()?></p>
                </div>
            </a>
            <?php
            if (isset($_SESSION['id'])) {?>
                <div class="flexColumn edit">
                    <a href="../index.php?controller=link&action=update&id=<?=$link->getId()?>"><i class="fas fa-pen-square"></i></a>
                    <a href="../index.php?controller=link&action=delete&id=<?=$link->getId()?>"><i class="fas fa-trash-alt"></i></a>
                </div>
                <?php
            }
        }
    }
    ?>
</main>
