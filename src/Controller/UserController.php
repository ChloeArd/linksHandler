<?php
namespace Chloe\LinksHandler\Controller;

use Chloe\LinksHandler\Model\Controller\Traits\ReturnViewTrait;

class UserController {

    use ReturnViewTrait;

    /**
     * Display a account page
     */
    public function account() {
        $this->return("accountView", "Mon compte");
    }
}