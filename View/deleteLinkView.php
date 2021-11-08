<?php
$id = $_GET['id'];
$manager = new \Chloe\LinksHandler\Model\Manager\LinkManager();
$link = $manager->getLinkId($id);

foreach ($link as $value) {?>
    <main>
        <h1 class="center">Supprimer le lien : <?=$value->getName()?></span></h1>
        <form method="post" action="" class="flexColumn flexCenter auto width80">
            <p class="center margTop40">Voulez vous vraiment supprimer ce lien ?</p>
            <input type="hidden" value="<?=$id?>" id="id" name="id">
            <input id="deleteLink" type="submit" name="submit" value="Oui" class="button margTop15">
            <a href="../../" class="button button2">Non</a>
        </form>
    </main>
    <?php
}