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
            $this->return("createLinkView", "Ajouter un lien");
        }
    }

    /**
     * update a link
     * @param $link
     */
    public function update($link) {
        if (isset($_SESSION['id'])) {
            $this->return("updateLinkView", "Modifier un lien");
        }
    }

    public function delete($link) {
        if (isset($_SESSION["id"])) {
            $this->return("deleteLinkView", "Suppirmer un lien");

        }
    }

}