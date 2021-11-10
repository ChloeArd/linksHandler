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
    default :
        break;
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