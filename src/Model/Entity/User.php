<?php

namespace Chloe\LinksHandler\Model\Entity;

class User {

    private ?int $id;
    private ?string $nom;
    private ?string $prenom;
    private ?string $mail;
    private ?string $pass;

    /**
     * @param int|null $id
     * @param string|null $nom
     * @param string|null $prenom
     * @param string|null $mail
     * @param string|null $pass
     */
    public function __construct(?int $id = null, ?string $nom = null, ?string $prenom = null, ?string $mail = null, ?string $pass = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->pass = $pass;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
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
    public function getNom(): ?string {
        return $this->nom;
    }

    /**
     * @param string|null $nom
     */
    public function setNom(?string $nom): ?string {
        $this->nom = $nom;
        return $nom;
    }

    /**
     * @return string|null
     */
    public function getPrenom(): ?string {
        return $this->prenom;
    }

    /**
     * @param string|null $prenom
     */
    public function setPrenom(?string $prenom): ?string {
        $this->prenom = $prenom;
        return $prenom;
    }

    /**
     * @return string|null
     */
    public function getMail(): ?string {
        return $this->mail;
    }

    /**
     * @param string|null $mail
     */
    public function setMail(?string $mail): ?string {
        $this->mail = $mail;
        return $mail;
    }

    /**
     * @return string|null
     */
    public function getPass(): ?string {
        return $this->pass;
    }

    /**
     * @param string|null $pass
     */
    public function setPass(?string $pass): ?string {
        $this->pass = $pass;
        return $pass;
    }
}