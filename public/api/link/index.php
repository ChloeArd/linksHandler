<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Model/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Model/Entity/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Model/Entity/Link.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Model/Manager/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/src/Model/Manager/LinkManager.php';


use Chloe\LinksHandler\Model\Entity\Link;
use Chloe\LinksHandler\Model\Manager\LinkManager;
use Chloe\LinksHandler\Model\Manager\UserManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];
$manager = new LinkManager();

switch($requestType) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo getLink($manager, intval($_GET['id']));
        }
        else {
            echo getLinks($manager);
        }
        break;
    case 'POST':
        $response = [
            'error' => 'success',
            'message' => 'Le lien a été crée avec succès',
        ];

        $data = json_decode(file_get_contents('php://input'));
        if(isset($data->href, $data->title, $data->target, $data->name, $data->click, $data->user_fk)) {
            $userManager = new UserManager();

            $href = htmlentities(trim($data->href));
            $title = htmlentities(trim(ucfirst($data->title)));
            $target = htmlentities(trim($data->target));
            $name = htmlentities(trim(ucfirst($data->name)));
            $user_fk = intval($data->user_fk);

            if (filter_var($href, FILTER_VALIDATE_URL)) {
                $user_fk = $userManager->getUser($user_fk);
                if ($user_fk->getId()) {
                    $link = new Link(null, $href, $title, $target, $name, null, $user_fk);
                    $result = $manager->add($link);
                    if (!$result) {
                        $response = [
                            'error' => 'danger',
                            'message' => 'Une erreur est survenue',
                        ];
                    }
                }
            }
            else {
                $response = [
                    'error' => 'danger',
                    'message' => 'L\'url n\'est pas valide',
                ];
            }

        }
        else {
            $response = [
                'error' => 'danger',
                'message' => 'Le lien, le titre, l\'affichage, ou le nom est manquant',
            ];
        }
        echo json_encode($response);
        break;
    case 'PUT':
        $response = [
            'error' => 'success',
            'message' => 'Le lien a été modifié avec succès',
        ];

        $data = json_decode(file_get_contents('php://input'));

        if (isset($_SESSION['id'])) {
            if (isset($data->id, $data->href, $data->title, $data->target, $data->name)) {
                $manager = new LinkManager();

                $id = intval($data->id);
                $href = htmlentities(trim($data->href));
                $title = htmlentities(trim(ucfirst($data->title)));
                $target = htmlentities(trim($data->target));
                $name = htmlentities(trim(ucfirst($data->name)));

                if (filter_var($href, FILTER_VALIDATE_URL)) {
                    $link = new Link($id, $href, $title, $target, $name);
                    $result = $manager->update($link);
                    if (!$result) {
                        $response = [
                            'error' => 'danger',
                            'message' => 'Une erreur est survenue',
                        ];
                    }
                }
                else {
                    $response = [
                        'error' => 'danger',
                        'message' => 'L\'url n\'est pas valide',
                    ];
                }
            }
            else {
                $response = [
                    'error' => 'danger',
                    'message' => 'Le lien, le titre, l\'affichage, ou le nom est manquant',
                ];
            }
        }
        echo json_encode($response);
        break;
    case 'DELETE':
        $response = [
            'error' => 'success',
            'message' => 'Le lien a été supprimé avec succès',
        ];

        $data = json_decode(file_get_contents('php://input'));

        if (isset($_SESSION["id"])) {
            if (isset($data->id)) {
                $manager = new LinkManager();

                $id = intval($data->id);

                $result = $manager->delete($id);
                if (!$result) {
                    $response = [
                        'error' => 'danger',
                        'message' => 'Une erreur est survenue',
                    ];
                }
            }
            else {
                $response = [
                    'error' => 'danger',
                    'message' => 'L\'id est manquant',
                ];
            }
        }
        break;
}

/**
 * Return the links.
 * @param LinkManager $manager
 * @return false|string
 */
function getLinks(LinkManager $manager): string {
    $response = [];
    $data = $manager->getLinks();
    foreach($data as $link) {
        /* @var Link $link */
        $response[] = [
            'id' => $link->getId(),
            'href' => $link->getHref(),
            'title' => $link->getTitle(),
            'target' => $link->getTarget(),
            'name' => $link->getName(),
            'user' => [
                'id' => $link->getUserFk()->getId(),
                'firstname' => $link->getUserFk()->getFirstname(),
                'lastname' => $link->getUserFk()->getLastname()
            ],
        ];
    }
    // Send the response (we encode our array in json format).
    return json_encode($response);
}

/**
 * Return only one message.
 * @param LinkManager $manager
 * @param int $id
 * @return string
 */
function getLink(LinkManager $manager, int $id): string {
    $link = $manager->getLink($id);
    $response[] = [
        'id' => $link->getId(),
        'href' => $link->getHref(),
        'title' => $link->getTitle(),
        'target' => $link->getTarget(),
        'name' => $link->getName(),
        'user' => [
            'id' => $link->getUserFk()->getId(),
            'firstname' => $link->getUserFk()->getFirstname(),
            'lastname' => $link->getUserFk()->getLastname()
        ],
    ];
    return json_encode($response);
}

exit;