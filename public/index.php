<?php
session_start();

require dirname(__FILE__) . '/../vendor/autoload.php';

require_once dirname(__FILE__) . '/../src/Controller/Traits/ReturnViewTrait.php';

use Chloe\LinksHandler\Controller\HomeController;
use Chloe\LinksHandler\Controller\LinkController;
use Chloe\LinksHandler\Controller\UserController;

if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        case 'home' :
            $controller = new HomeController();
            if (isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case 'connection' :
                        $controller->connection();
                        break;
                    case 'registration' :
                        $controller->registration();
                        break;
                    case 'contact' :
                        $controller->contact();
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
        case 'user' :
            $controller = new UserController();
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'account':
                        $controller->account();
                        break;
                    case 'statistic':
                        $controller->statistic();
                        break;
                }
            }
    }
}
else {
    $controller = new HomeController();
    $controller->homePage($_POST);
}