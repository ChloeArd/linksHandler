<?php
namespace Chloe\LinksHandler\Controller;

use Chloe\LinksHandler\Model\Controller\Traits\ReturnViewTrait;
use Chloe\LinksHandler\Model\Manager\LinkManager;

class UserController {

    use ReturnViewTrait;

    /**
     * Display a account page
     */
    public function account() {
        $this->return("accountView", "Mon compte");
    }

    public function statistic() {
        $linkManager = new LinkManager();
        $stat1 = $linkManager->getLinks();

        $this->return("statisticView", "Mes statistiques", ["stat1" => $stat1]);
    }
}