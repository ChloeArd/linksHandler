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

    /**
     * display the registration page
     */
    public function registration() {
        $this->return("registrationView", "Inscription");
    }

    /**
     * display the contact page
     */
    public function contact() {
        $this->return("contactView", "Contact");
    }
}