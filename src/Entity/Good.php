<?php

namespace App\Entity;

use App\Repository\GoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GoodRepository::class)
 */
class Good
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="goods")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idcategory;

    //додав cascade і ->...
    /**
     * @ORM\OneToMany(targetEntity=GoodOrder::class, mappedBy="idgood")
     */
    private $goodOrders;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function __construct()
    {
        $this->goodOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIdcategory(): ?Category
    {
        return $this->idcategory;
    }

    public function setIdcategory(?Category $idcategory): self
    {
        $this->idcategory = $idcategory;

        return $this;
    }

    /**
     * @return Collection|GoodOrder[]
     */
    public function getGoodOrders(): Collection
    {
        return $this->goodOrders;
    }

    public function addGoodOrder(GoodOrder $goodOrder): self
    {
        if (!$this->goodOrders->contains($goodOrder)) {
            $this->goodOrders[] = $goodOrder;
            $goodOrder->setIdgood($this);
        }

        return $this;
    }

    public function removeGoodOrder(GoodOrder $goodOrder): self
    {
        if ($this->goodOrders->removeElement($goodOrder)) {
            // set the owning side to null (unless already changed)
            if ($goodOrder->getIdgood() === $this) {
                $goodOrder->setIdgood(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
