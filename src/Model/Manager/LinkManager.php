<?php

namespace Chloe\LinksHandler\Model\Manager;

require_once __DIR__ . "/../DB.php";
require_once "Traits/ManagerTrait.php";
require_once "UserManager.php";

use Chloe\LinksHandler\Model\DB;
use Chloe\LinksHandler\Model\Entity\Link;
use Chloe\LinksHandler\Model\Manager\Traits\ManagerTrait;

class LinkManager {

    use ManagerTrait;

    private UserManager $userManager;

    public function __construct() {
        $this->userManager = new UserManager();
    }

    /**
     * Return a link
     * @param $id
     * @return Link
     */
    public function getLink( $id): Link {
        $request = DB::getInstance()->prepare("SELECT * FROM prefix_link WHERE id = :id");
        $id = intval($id);
        $request->bindParam(":id", $id);
        $request->execute();
        $info = $request->fetch();
        $link = new Link();
        if ($info) {
            $link->setId($info['id']);
            $link->setHref($info['href']);
            $link->setTitle($info['title']);
            $link->setTarget($info['target']);
            $link->setName($info['name']);
            $link->setImage($info['image']);
            $link->setClick($info['click']);
            $user = $this->userManager->getUser($info['user_fk']);
            $link->setUserFk($user);
        }
        return $link;
    }

    /**
     * return all links
     * @return array
     */
    public function getLinks(): array {
        $link = [];
        $request = DB::getInstance()->prepare("SELECT * FROM prefix_link ORDER by id DESC");
        if($request->execute()) {
            foreach ($request->fetchAll() as $info) {
                $user = UserManager::getManager()->getUser($info['user_fk']);
                if($user->getId()) {
                    $link[] = new Link($info['id'], $info['href'], $info['title'], $info['target'], $info['name'], $info['image'], $info['click'], $user);
                }
            }
        }
        return $link;
    }

    /**
     * return a link
     * @param int $id
     * @return array
     */
    public function getLinkId(int $id): array {
        $link = [];
        $request = DB::getInstance()->prepare("SELECT * FROM prefix_link WHERE id = :id");
        $request->bindValue(":id", $id);
        if($request->execute()) {
            foreach ($request->fetchAll() as $info) {
                $user = UserManager::getManager()->getUser($info['user_fk']);
                if($user->getId()) {
                    $link[] = new Link($info['id'], $info['href'], $info['title'], $info['target'], $info['name'], $info['image'], $info['click'], $user);
                }
            }
        }
        return $link;
    }

    /**
     * add a link
     * @param Link $link
     * @return bool
     */
    public function add (Link $link): bool {
        $request = DB::getInstance()->prepare("
            INSERT INTO prefix_link (href, title, target, name, image, click, user_fk)
                VALUES (:href, :title, :target, :name, :image, :click, :user_fk) 
        ");

        $request->bindValue(':href', $link->getHref());
        $request->bindValue(':title', $link->getTitle());
        $request->bindValue(':target', $link->getTarget());
        $request->bindValue(':name', $link->getName());
        $request->bindValue(':image', $link->getImage());
        $request->bindValue(':click',$link->getClick());
        $request->bindValue(':user_fk', $link->getUserFk()->getId());

        return $request->execute() && DB::getInstance()->lastInsertId() != 0;
    }

    /**
     * update a link
     * @param Link $link
     * @return bool
     */
    public function update(Link $link): bool {
        $request = DB::getInstance()->prepare("UPDATE prefix_link SET href = :href, title = :title, target = :target, name = :name, image = :image WHERE id = :id");

        $request->bindValue(":id", $link->getId());
        $request->bindValue(":href", $link->setHref($link->getHref()));
        $request->bindValue(":title", $link->setTitle($link->getTitle()));
        $request->bindValue(":target", $link->setTarget($link->getTarget()));
        $request->bindValue(":name", $link->setName($link->getName()));
        $request->bindValue(":image", $link->setImage($link->getImage()));

        return $request->execute();
    }

    public function addClick(Link $link): bool {
        $request = DB::getInstance()->prepare("UPDATE prefix_link SET click = :click WHERE id = :id");

        $request->bindValue(":id", $link->getId());
        $request->bindValue(":click", $link->setClick($link->getClick()));

        return $request->execute();
    }

    /**
     * delete a link
     * @param int $id
     */
    public function delete(int $id) : int {
        $request = DB::getInstance()->prepare("DELETE FROM prefix_link WHERE id = :id");
        $request->bindValue(":id", $id);
        return $request->execute();
    }

}

