<?php

namespace Chloe\LinksHandler\Model\Manager;

use Chloe\LinksHandler\Model\DB;
use Chloe\LinksHandler\Model\Entity\Link;
use Chloe\LinksHandler\Model\Manager\Traits\ManagerTrait;

class LinkManager {

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
            $link->setSrc($info['src']);
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
                $link[] = new Link($info['id'], $info['href'], $info['title'], $info['target'], $info['name'], $info['src']);
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
                $link[] = new Link($info['id'], $info['href'], $info['title'], $info['target'], $info['name'], $info['src']);
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
            INSERT INTO prefix_link (href, title, target, name, src)
                VALUES (:href, :title, :target, :name, :src) 
        ");

        $request->bindValue(':href', $link->getHref());
        $request->bindValue(':title', $link->getTitle());
        $request->bindValue(':target', $link->getTarget());
        $request->bindValue(':name', $link->getName());
        $request->bindValue(':src', $link->getSrc());

        return $request->execute() && DB::getInstance()->lastInsertId() != 0;
    }

    /**
     * update a link
     * @param Link $link
     * @return bool
     */
    public function update(Link $link): bool {
        $request = DB::getInstance()->prepare("UPDATE prefix_link SET href = :href, title = :title, target = :target, name = :name, src = :src WHERE id = :id");

        $request->bindValue(":id", $link->getId());
        $request->bindValue(":href", $link->setHref($link->getHref()));
        $request->bindValue(":title", $link->setTitle($link->getTitle()));
        $request->bindValue(":target", $link->setTarget($link->getTarget()));
        $request->bindValue(":name", $link->setName($link->getName()));
        $request->bindValue(":src", $link->setSrc($link->getSrc()));

        return $request->execute();
    }

    /**
     * delete a link
     * @param int $id
     */
    public function delete(int $id) {
        $request = DB::getInstance()->prepare("DELETE FROM prefix_link WHERE id = :id");
        $request->bindValue(":id", $id);
        $request->execute();
    }
}