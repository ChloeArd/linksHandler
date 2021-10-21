<?php
session_start();

require 'vendor/autoload.php';

require_once 'src/Controller/Traits/ReturnViewTrait.php';

use Chloe\LinksHandler\Controller\HomeController;
use Chloe\LinksHandler\Controller\LinkController;

if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        case 'home' :
            if (isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case 'connection' :
                        $controller = new HomeController();
                        $controller->connection();
                        break;
                }
            }
        case 'link' :
            $controller = new LinkController();
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'add' :
                        $controller->add($_POST);
                        break;
                    case 'update':
                        $controller->update($_POST);
                        break;
                    case 'delete':
                        $controller->delete($_POST);
                        break;
                }
            }
    }
}
else {
    $controller = new HomeController();
    $controller->homePage();
}