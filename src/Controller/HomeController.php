<?php

namespace Chloe\LinksHandler\Controller;

use Chloe\LinksHandler\Model\Controller\Traits\ReturnViewTrait;
use Chloe\LinksHandler\Model\Entity\Link;
use Chloe\LinksHandler\Model\Manager\LinkManager;


class HomeController {

    use ReturnViewTrait;

    /**
     * display the home page
     */
    public function homePage($link) {
        $manager = new LinkManager();
        $links = $manager->getLinks();
        if (isset($link['id'], $link['href'], $link['target'], $link['click'])) {
            $manager = new LinkManager();

            $id = intval($link['id']);
            $href = $link['href'];
            $target = $link['target'];
            $click = intval($link['click']) + 1;

            $link = new Link($id, $href,'', $target, '', $click);
            $manager->addClick($link);
            if ($target == "_blank") {
                header("Location: $href", false);
            }
            else {
                header("Location: $href");
            }
        }
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