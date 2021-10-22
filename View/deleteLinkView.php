<?php
$id = $_GET['id'];
$manager = new \Chloe\LinksHandler\Model\Manager\LinkManager();
$link = $manager->getLinkId($id);

foreach ($link as $value) {?>
    <main>
        <h1 class="center">Supprimer le lien : <?=$value->getName()?></span></h1>
        <form method="post" action="" class="flexColumn flexCenter auto">
            <p class="center margTop40">Voulez vous vraiment supprimer ce lien ?</p>
            <input type="hidden" value="<?=$id?>" name="id">
            <input type="submit" name="submit" value="Oui" class="button margTop15">
            <a href="../public/index.php" class="button button2">Non</a>
        </form>
    </main>
    <?php
}