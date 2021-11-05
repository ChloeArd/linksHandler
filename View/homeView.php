<main class="flexRow flexCenter wrap">
    <?php
    if (isset($var['links'])) {
        foreach ($var['links'] as $link) {?>
                <!--<form id="linkContainer" action="" method="post">
                    <input type="hidden" name="id" value="<?=$link->getId()?>">
                    <input type="hidden" name="href" value="<?=$link->getHref()?>">
                    <input type="hidden" name="target" value="<?=$link->getTarget()?>">
                    <input type="hidden" name="click" value="<?=$link->getClick()?>">
                    <div id="container1" class="flexColumn width100">
                        <div id="containerPicture">
                            <img src="<?=$link->getImage()?>" alt="<?=$link->getTitle()?>">
                        </div>
                        <div id="containerLink" class="flexCenter">
                            <input class="buttonLink" type="submit" name="send" value="<?=$link->getName()?>">
                        </div>
                    </div>
                </form>-->
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
    <div id="test" class="width100 flexRow wrap flexCenter"></div>
</main>
