<?php
session_start();

require dirname(__FILE__) . '/../vendor/autoload.php';

use Chloe\LinksHandler\Model\Manager\LinkManager;

if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        case 'home' :
            if (isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case 'connection' :
                        page("connectionView", "Connexion");
                        break;
                    case 'registration' :
                        page("registrationView", "Inscription");
                        break;
                    case 'contact' :
                        page("contactView", "Contact");
                        break;
                }
            }
        case 'link' :
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'myLink' :
                        if (isset($_SESSION['id'])) {
                            page("accountLinkView", "Mes liens");
                        }
                        break;
                    case 'add' :
                        if (isset($_SESSION['id'])) {
                            page("createLinkView", "Ajouter un lien");
                        }
                        break;
                    case 'update':
                        if (isset($_SESSION['id'])) {
                            page("updateLinkView", "Modifier un lien");
                        }
                        break;
                    case 'delete':
                        if (isset($_SESSION["id"])) {
                            page("deleteLinkView", "Suppirmer un lien");
                        }
                        break;
                }
            }
        case 'user' :
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'account':
                        page("accountView", "Mon compte");
                        break;
                    case 'statistic':
                        $linkManager = new LinkManager();
                        $stat1 = $linkManager->getLinks();
                        page("statisticView", "Mes statistiques", ["stat1" => $stat1]);
                        break;
                    case 'update':
                        if (isset($_GET['id'])) {
                            if ($_GET['id'] === $_SESSION['id']) {
                                page("updateUserView", "Modifier mes informations");
                            }
                        }
                        break;
                    case 'updatePass':
                        if (isset($_GET['id'])) {
                            if ($_GET['id'] === $_SESSION['id']) {
                                page("updatePassUserView", "Changer mon mot de passe");
                            }
                        }
                        break;
                    case 'delete':
                        if (isset($_GET['id'])) {
                            if ($_GET['id'] === $_SESSION['id']) {
                                page("deleteUserView", "Supprimer mon compte");
                            }
                        }
                        break;
                }
            }
    }
}
else {
    $manager = new LinkManager();
    $links = $manager->getLinks();
    page("homeView", "Links Handler");
}

function page(string $view, string $title, array $var = null) {
    ob_start();
    require_once dirname(__FILE__) . "/../View/$view.php";
    $html = ob_get_clean();
    require_once dirname(__FILE__) . "/../View/_Partials/structureView.php";
}