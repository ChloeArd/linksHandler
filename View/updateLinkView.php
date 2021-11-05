<?php
$id = $_GET['id'];
$manager = new \Chloe\LinksHandler\Model\Manager\LinkManager();
$link = $manager->getLinkId($id);?>

<main>
    <h1 class="center">Modifier un lien</h1>
    <form method="post" action="" class="flexColumn flexCenter width80 auto">
        <?php
            foreach ($link as $value) {?>
                <label for="href">L'URL du lien</label>
                <input type="url" id="href" name="href" value="<?=$value->getHref()?>" required>
                <label for="title">Titre de l'image</label>
                <input type="text" id="title" name="title" value="<?=$value->getTitle()?>" required>
                <label for="target">Où afficher l'URL liée</label>
                <select id="target" name="target" required>
                    <option value="<?=$value->getTarget()?>">
                        <?php
                        if ($value->getTarget() === "_self") {
                            echo "Le contexte de navigation actuel";
                        }
                        elseif ($value->getTarget() === "_blank") {
                            echo "Un nouvel onglet";
                        }
                        elseif ($value->getTarget() === "_parent") {
                            echo "Le contexte de navigation parent de celui en cours";
                        }
                        else {
                            echo "Le contexte de navigation le plus haut";
                        }
                        ?>
                    </option>
                    <option value="_self">Le contexte de navigation actuel</option>
                    <option value="_blank">Un nouvel onglet</option>
                    <option value="_parent">Le contexte de navigation parent de celui en cours</option>
                    <option value="_top">Le contexte de navigation le plus haut</option>
                </select>
                <label for="name">Nom du lien</label>
                <input type="text" id="name" name="name" value="<?=$value->getName()?>" required>
                <input id="id" type="hidden" name="id" value="<?=$id?>">
                <input id="updateLink" type="submit" name="submit" value="Modifier" class="button">
            <?php
            }
            ?>
    </form>
</main>
