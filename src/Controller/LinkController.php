<?php
namespace Chloe\LinksHandler\Controller;

use Chloe\LinksHandler\Model\Controller\Traits\ReturnViewTrait;
use Chloe\LinksHandler\Model\Entity\Link;
use Chloe\LinksHandler\Model\Manager\LinkManager;

class LinkController {

    use ReturnViewTrait;

    /**
     * add a link
     * @param $link
     */
    public function add($link) {
        if (isset($_SESSION['id'])) {
            if (isset($link['href'], $link['title'], $link['target'], $link['name'], $link['src'])) {
                $manager = new LinkManager();

                $href = htmlentities(trim($link['href']));
                $title = htmlentities(trim(ucfirst($link['title'])));
                $target = htmlentities(trim($link['target']));
                $name = htmlentities(trim(ucfirst($link['name'])));
                $src = htmlentities(trim($link['src']));

                if (filter_var($href, FILTER_VALIDATE_URL)) {
                    if (filter_var($src, FILTER_VALIDATE_URL)) {
                        $link = new Link(null, $href, $title, $target, $name, $src);
                        $manager->add($link);
                        header("Location: ../index.php?success=0");
                    }
                    else {
                        header("Location: ../index.php?controller=link&action=add&error=0");
                    }
                }
                else {
                    header("Location: ../index.php?controller=link&action=add&error=1");
                }
            }
            $this->return("createLinkView", "Ajouter un lien");
        }
    }

    /**
     * update a link
     * @param $link
     */
    public function update($link) {
        if (isset($_SESSION['id'])) {
            if (isset($link['id'], $link['href'], $link['title'], $link['target'], $link['name'], $link['src'])) {
                $manager = new LinkManager();

                $id = intval($link['id']);
                $href = htmlentities(trim($link['href']));
                $title = htmlentities(trim(ucfirst($link['title'])));
                $target = htmlentities(trim($link['target']));
                $name = htmlentities(trim(ucfirst($link['name'])));
                $src = htmlentities(trim($link['src']));

                if (filter_var($href, FILTER_VALIDATE_URL)) {
                    if (filter_var($src, FILTER_VALIDATE_URL)) {
                        $link = new Link($id, $href, $title, $target, $name, $src);
                        $manager->update($link);
                        header("Location: ../index.php?success=0");
                    }
                    else {
                        header("Location: ../index.php?controller=link&action=update&id=$id&error=0");
                    }
                }
                else {
                    header("Location: ../index.php?controller=link&action=update&id=$id&error=1");
                }
            }
            $this->return("updateLinkView", "Modifier un lien");
        }
    }

    public function delete($link) {
        if (isset($_SESSION["id"])) {
                if (isset($link['id'])) {
                    $manager = new LinkManager();

                    $id = intval($link['id']);

                    $manager->delete($id);
                    header("Location: ../index.php?success=1");
                }
                $this->return("deleteLinkView", "Suppirmer un lien");
            }
    }

}