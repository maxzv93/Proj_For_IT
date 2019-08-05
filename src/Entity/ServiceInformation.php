<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiceInformationRepository")
 */
class ServiceInformation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Phone1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Phone2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Phone3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Email1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Email2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhone1(): ?string
    {
        return $this->Phone1;
    }

    public function setPhone1(?string $Phone1): self
    {
        $this->Phone1 = $Phone1;

        return $this;
    }

    public function getPhone2(): ?string
    {
        return $this->Phone2;
    }

    public function setPhone2(?string $Phone2): self
    {
        $this->Phone2 = $Phone2;

        return $this;
    }

    public function getPhone3(): ?string
    {
        return $this->Phone3;
    }

    public function setPhone3(?string $Phone3): self
    {
        $this->Phone3 = $Phone3;

        return $this;
    }

    public function getEmail1(): ?string
    {
        return $this->Email1;
    }

    public function setEmail1(?string $Email1): self
    {
        $this->Email1 = $Email1;

        return $this;
    }

    public function getEmail2(): ?string
    {
        return $this->Email2;
    }

    public function setEmail2(?string $Email2): self
    {
        $this->Email2 = $Email2;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(?string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }
}
