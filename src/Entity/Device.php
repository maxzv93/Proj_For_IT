<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeviceRepository")
 */
class Device
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Producer;

    /**
     * @ORM\Column(type="integer")
     */
    private $Price;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Display;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $MemorySize;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $RefPicture;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDelete;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="devices")
     */
    private $ShopUser;

    public function __construct()
    {
        $this->ShopUser = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->Model;
    }

    public function setModel(string $Model): self
    {
        $this->Model = $Model;

        return $this;
    }

    public function getProducer(): ?string
    {
        return $this->Producer;
    }

    public function setProducer(string $Producer): self
    {
        $this->Producer = $Producer;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(int $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getDisplay(): ?float
    {
        return $this->Display;
    }

    public function setDisplay(?float $Display): self
    {
        $this->Display = $Display;

        return $this;
    }

    public function getMemorySize(): ?int
    {
        return $this->MemorySize;
    }

    public function setMemorySize(?int $MemorySize): self
    {
        $this->MemorySize = $MemorySize;

        return $this;
    }

    public function getRefPicture(): ?string
    {
        return $this->RefPicture;
    }

    public function setRefPicture(?string $RefPicture): self
    {
        $this->RefPicture = $RefPicture;

        return $this;
    }

    public function getIsDelete(): ?bool
    {
        return $this->isDelete;
    }

    public function setIsDelete(?bool $isDelete): self
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getShopUser(): Collection
    {
        return $this->ShopUser;
    }

    public function addShopUser(User $shopUser): self
    {
        if (!$this->ShopUser->contains($shopUser)) {
            $this->ShopUser[] = $shopUser;
        }

        return $this;
    }

    public function removeShopUser(User $shopUser): self
    {
        if ($this->ShopUser->contains($shopUser)) {
            $this->ShopUser->removeElement($shopUser);
        }

        return $this;
    }

}
