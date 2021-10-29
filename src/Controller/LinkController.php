<?php
namespace Chloe\LinksHandler\Controller;

use Chloe\LinksHandler\Model\Controller\Traits\ReturnViewTrait;
use Chloe\LinksHandler\Model\Entity\Link;
use Chloe\LinksHandler\Model\Manager\LinkManager;
use Chloe\LinksHandler\Model\Manager\UserManager;

class LinkController {

    use ReturnViewTrait;

    /**
     * add a link
     * @param $link
     */
    public function add($link) {
        if (isset($_SESSION['id'])) {
            if (isset($link['href'], $link['title'], $link['target'], $link['name'], $link['user_fk'])) {
                $manager = new LinkManager();
                $userManager = new UserManager();

                $href = htmlentities(trim($link['href']));
                $title = htmlentities(trim(ucfirst($link['title'])));
                $target = htmlentities(trim($link['target']));
                $name = htmlentities(trim(ucfirst($link['name'])));
                $user_fk = intval($link['user_fk']);

                if (filter_var($href, FILTER_VALIDATE_URL)) {
                    $user_fk = $userManager->getUser($user_fk);
                    if ($user_fk->getId()) {
                        $link = new Link(null, $href, $title, $target, $name, null, $user_fk);
                        $manager->add($link);
                        header("Location: ../index.php?success=0");
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
            if (isset($link['id'], $link['href'], $link['title'], $link['target'], $link['name'])) {
                $manager = new LinkManager();

                $id = intval($link['id']);
                $href = htmlentities(trim($link['href']));
                $title = htmlentities(trim(ucfirst($link['title'])));
                $target = htmlentities(trim($link['target']));
                $name = htmlentities(trim(ucfirst($link['name'])));

                if (filter_var($href, FILTER_VALIDATE_URL)) {
                    $link = new Link($id, $href, $title, $target, $name);
                    $manager->update($link);
                    header("Location: ../index.php?success=0");
                }
                else {
                    header("Location: ../index.php?controller=link&action=update&id=$id&error=1");
                }
            }
            $this->return("updateLinkView", "Modifier un lien");
        }
    }

    /**
     * add a click to each click on a link
     * @param Link $link
     */
    public function addClick(Link $link) {
        if (isset($link['id'], $link['href'], $link['click'])) {
            $manager = new LinkManager();

            $id = intval($link['id']);
            $href = $link['href'];
            $click = $link['click'] + 1;

            $link = new Link($id, $href, $click);
            $manager->addClick($link);
            header("Location: $href");

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