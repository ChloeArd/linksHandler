<?php

namespace Chloe\LinksHandler\Controller;

use Chloe\LinksHandler\Model\Controller\Traits\ReturnViewTrait;
use Chloe\LinksHandler\Model\Manager\LinkManager;

class HomeController {

    use ReturnViewTrait;

    /**
     * display the home page
     */
    public function homePage() {
        $manager = new LinkManager();
        $links = $manager->getLinks();
        $this->return("homeView", "Links Handler", ['links' => $links]);
    }

    /**
     * display the connection page
     */
    public function connection() {
        $this->return("connectionView", "Connexion");
    }
}