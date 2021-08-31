<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $addingdate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $buyingdate;

    /**
     * @ORM\OneToMany(targetEntity=GoodOrder::class, mappedBy="order", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $goodOrders;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
//    private $iduser;

    //встановлення статуса за замовчуванням
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status = self::STATUS_CART;

    //оголошення константи
    /**
     * An order that is in progress, not placed yet.
     *
     * @var string
     */
    const STATUS_CART = 'cart';


    //видалення всіх елементів із Order
    /**
     * Removes all items from the order.
     *
     * @return $this
     */
    public function removeGoodOrders(): self
    {
        foreach ($this->getGoodOrders() as $goodOrder) {
            $this->removeGoodOrder($goodOrder);
        }

        return $this;
    }

    public function __construct()
    {
        $this->goodOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddingdate(): ?\DateTimeInterface
    {
        return $this->addingdate;
    }

    public function setAddingdate(\DateTimeInterface $addingdate): self
    {
        $this->addingdate = $addingdate;

        return $this;
    }

    public function getBuyingdate(): ?\DateTimeInterface
    {
        return $this->buyingdate;
    }

    public function setBuyingdate(?\DateTimeInterface $buyingdate): self
    {
        $this->buyingdate = $buyingdate;

        return $this;
    }

    /**
     * @return Collection|GoodOrder[]
     */
    public function getGoodOrders(): Collection
    {
        return $this->goodOrders;
    }

//    public function addGoodOrder(GoodOrder $goodOrder): self
//    {
//        if (!$this->goodOrders->contains($goodOrder)) {
//            $this->goodOrders[] = $goodOrder;
//            $goodOrder->setOrder($this);
//        }
//
//        return $this;
//    }

    //сумування кількості якщо товар уже існує
    public function addGoodOrder(GoodOrder $goodOrder): self
    {
        foreach ($this->getGoodOrders() as $existingGoodOrder) {
            // The item already exists, update the quantity
            if ($existingGoodOrder->equals($goodOrder)) {
                $existingGoodOrder->setAmount(
                    $existingGoodOrder->getAmount() + $goodOrder->getAmount()
                );
                return $this;
            }
        }

        $this->goodOrders[] = $goodOrder;
        $goodOrder->setOrder($this);

        return $this;
    }

    /**
     * Calculates the order total.
     *
     * @return float
     */
    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->getGoodOrders() as $goodOrder) {
            $total += $goodOrder->getTotal();
        }

        return $total;
    }

    public function removeGoodOrder(GoodOrder $goodOrder): self
    {
        if ($this->goodOrders->removeElement($goodOrder)) {
            // set the owning side to null (unless already changed)
            if ($goodOrder->getOrder() === $this) {
                $goodOrder->setOrder(null);
            }
        }

        return $this;
    }

//    public function getIduser(): ?User
//    {
//        return $this->iduser;
//    }
//
//    public function setIduser(?User $iduser): self
//    {
//        $this->iduser = $iduser;
//
//        return $this;
//    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
