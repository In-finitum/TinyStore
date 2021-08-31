<?php

namespace App\Entity;

use App\Repository\GoodOrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GoodOrderRepository::class)
 */
class GoodOrder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
//    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(1)
     */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity=Good::class, inversedBy="goodOrders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $good;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="goodOrders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order;


    //для того щоб не додавати повторно одні і ті самі сутності
    /**
     * Tests if the given item given corresponds to the same order item.
     *
     * @param GoodOrder $goodOrder
     *
     * @return bool
     */
    public function equals(GoodOrder $goodOrder): bool
    {
        return $this->getGood()->getId() === $goodOrder->getGood()->getId();
    }

    //підрахунок загальної суми
    /**
     * Calculates the item total.
     *
     * @return float|int
     */
    public function getTotal(): float
    {
        return ($this->getGood()->getPrice()/100) * $this->getAmount();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

//    public function getPrice(): ?int
//    {
//        return $this->price;
//    }
//
//    public function setPrice(int $price): self
//    {
//        $this->price = $price;
//
//        return $this;
//    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getGood(): ?Good
    {
        return $this->good;
    }

    public function setGood(?Good $good): self
    {
        $this->good = $good;

        return $this;
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function setOrder(?Order $order): self
    {
        $this->order = $order;

        return $this;
    }
}
