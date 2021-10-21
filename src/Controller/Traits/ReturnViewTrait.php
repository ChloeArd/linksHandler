<?php

namespace Chloe\LinksHandler\Model\Controller\Traits;

trait ReturnViewTrait {

    /**
     * Allows you to display the right pages, the right content, the structure page,
     * the title of the page and the information you want to have.
     * @param string $view
     * @param string $title
     * @param array|null $var
     */
    public function return(string $view, string $title, array $var = null) {
        ob_start();
        require_once $_SERVER['DOCUMENT_ROOT'] . "/View/$view.php";
        $html = ob_get_clean();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/_Partials/structureView.php';
    }
}