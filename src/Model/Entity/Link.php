<?php

namespace Chloe\LinksHandler\Model\Entity;

class Link {

    private ?int $id;
    private ?string $href;
    private ?string $title;
    private ?string $target;
    private ?string $name;

    /**
     * @param int|null $id
     * @param string|null $href
     * @param string|null $title
     * @param string|null $target
     * @param string|null $name
     */
    public function __construct(?int $id = null, ?string $href =null, ?string $title = null, ?string $target = null, ?string $name = null) {
        $this->id = $id;
        $this->href = $href;
        $this->title = $title;
        $this->target = $target;
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): ?int {
        $this->id = $id;
        return $id;
    }

    /**
     * @return string|null
     */
    public function getHref(): ?string {
        return $this->href;
    }

    /**
     * @param string|null $href
     */
    public function setHref(?string $href): ?string {
        $this->href = $href;
        return $href;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): ?string {
        $this->title = $title;
        return $title;
    }

    /**
     * @return string|null
     */
    public function getTarget(): ?string {
        return $this->target;
    }

    /**
     * @param string|null $target
     */
    public function setTarget(?string $target): ?string {
        $this->target = $target;
        return $target;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): ?string {
        $this->name = $name;
        return $name;
    }
}