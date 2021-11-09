<?php

require_once '../../../src/Model/DB.php';
require_once '../../../src/Model/Entity/Link.php';
require_once '../../../src/Model/Entity/User.php';
require_once '../../../src/Model/Entity/Role.php';
require_once '../../../src/Model/Manager/LinkManager.php';
require_once '../../../src/Model/Manager/UserManager.php';

use Chloe\LinksHandler\Model\Entity\Link;
use Chloe\LinksHandler\Model\Manager\LinkManager;
use Chloe\LinksHandler\Model\Manager\UserManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];
$manager = new LinkManager();

switch($requestType) {
    case 'GET':
            echo getLinks($manager);
        break;

    case 'POST':
        $response = [
            'error' => 'success',
            'message' => 'Le lien a été créé avec succès.',
        ];

        $data = json_decode(file_get_contents('php://input'));
        if (isset($data->href, $data->title, $data->target, $data->name, $data->user_fk)) {
            $userManager = new UserManager();

            $href = htmlentities(trim($data->href));
            $title = htmlentities(trim(ucfirst($data->title)));
            $target = htmlentities(trim($data->target));
            $name = htmlentities(trim(ucfirst($data->name)));
            $image = thumbalizr($data->href);
            $user_fk = intval($data->user_fk);

            if (filter_var($href, FILTER_VALIDATE_URL)) {
                $user_fk = $userManager->getUser($user_fk);
                if ($user_fk->getId()) {
                    $link = new Link(null, $href, $title, $target, $name, $image, 1, $user_fk);
                    $result = $manager->add($link);
                    if (!$result) {
                        $response = [
                            'error' => 'error1',
                            'message' => 'Une erreur est survenue.',
                        ];
                    }
                }
            }
            else {
                $response = [
                    'error' => 'error2',
                    'message' => 'L\'url n\'est pas valide.',
                ];
            }

        }
        else {
            $response = [
                'error' => 'error3',
                'message' => 'Le lien, le titre, l\'affichage, ou le nom est manquant.',
            ];
        }
        echo json_encode($response);
        break;

    case 'PUT':
        $response = [
            'error' => 'success',
            'message' => 'Le lien a été modifié avec succès.',
        ];

        $data = json_decode(file_get_contents('php://input'));
        if (isset($data->id, $data->href, $data->title, $data->target, $data->name)) {

            $id = intval($data->id);
            $href = htmlentities(trim($data->href));
            $title = htmlentities(trim(ucfirst($data->title)));
            $target = htmlentities(trim($data->target));
            $name = htmlentities(trim(ucfirst($data->name)));
            $image = thumbalizr($data->href);

            if (filter_var($href, FILTER_VALIDATE_URL)) {
                $link = new Link($id, $href, $title, $target, $name, $image);
                $result = $manager->update($link);
                if (!$result) {
                    $response = [
                        'error' => 'error1',
                        'message' => 'Une erreur est survenue.',
                    ];
                }
            }
            else {
                $response = [
                    'error' => 'error2',
                    'message' => 'L\'url n\'est pas valide.',
                ];
            }
        }
        else {
            $response = [
                'error' => 'error3',
                'message' => 'Le lien, le titre, l\'affichage, ou le nom est manquant.',
            ];
        }

        if (isset($data->id, $data->href, $data->target, $data->click)) {
            $manager = new LinkManager();

            $id = intval($data->id);
            $href = $data->href;
            $target = $data->target;
            $click = intval($data->click) + 1;

            $link = new Link($id, $href,'', $target, '', '', $click);
            $manager->addClick($link);
        }

        echo json_encode($response);
        break;

    case 'DELETE':
        $response = [
            'error' => 'success',
            'message' => 'Le lien a été supprimé avec succès.',
        ];

        $data = json_decode(file_get_contents('php://input'));
        if (isset($data->id)) {
            $manager = new LinkManager();
            $id = intval($data->id);
            $result = $manager->delete($id);

            if (!$result) {
                $response = [
                    'error' => 'error1',
                    'message' => 'Une erreur est survenue.',
                ];
            }
        }
        else {
            $response = [
                'error' => 'error2',
                'message' => 'L\'id est manquant.',
            ];
        }
        echo json_encode($response);
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
            'image' => $link->getImage(),
            'click' => $link->getClick(),
            'user' => [
                'id' => $link->getUserFk()->getId(),
                'firstname' => $link->getUserFk()->getFirstname(),
                'lastname' => $link->getUserFk()->getLastname(),
                'role' => [
                    'id' => $link->getUserFk()->getRoleFk()->getId(),
                ]
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
function getLinksUser(LinkManager $manager, int $id): string {
    $data = $manager->getLinksUser($id);
    foreach($data as $link) {
        /* @var Link $link */
        $response[] = [
            'id' => $link->getId(),
            'href' => $link->getHref(),
            'title' => $link->getTitle(),
            'target' => $link->getTarget(),
            'name' => $link->getName(),
            'image' => $link->getImage(),
            'click' => $link->getClick(),
            'user' => [
                'id' => $link->getUserFk()->getId(),
                'firstname' => $link->getUserFk()->getFirstname(),
                'lastname' => $link->getUserFk()->getLastname(),
                'role' => [
                    'id' => $link->getUserFk()->getRoleFk()->getId(),
                ]
            ],
        ];
    }
    return json_encode($response);
}

// Integration of the thumbalizr function to be able to integrate thumbnails directly on my website
function thumbalizr($url, $options = array()) {
    $embed_key = "zFxVAff4lQewBOVFMDT7T2VYBXR";
    $secret = 'K6YFjElYCQ6SGvuVztslN2GDx7Z';

    $query = 'url=' . urlencode($url);

    foreach($options as $key => $value) {
        $query .= '&' . trim($key) . '=' . urlencode(trim($value));

    }
    $token = md5($query . $secret);

    return "https://api.thumbalizr.com/api/v1/embed/$embed_key/$token/?$query";
}