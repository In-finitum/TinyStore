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
    private $idgood;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="goodOrders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idorder;


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
        return $this->getIdgood()->getId() === $goodOrder->getIdgood()->getId();
    }

    //підрахунок загальної суми
    /**
     * Calculates the item total.
     *
     * @return float|int
     */
    public function getTotal(): float
    {
        return ($this->getIdgood()->getPrice()/100) * $this->getAmount();
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

    public function getIdgood(): ?Good
    {
        return $this->idgood;
    }

    public function setIdgood(?Good $idgood): self
    {
        $this->idgood = $idgood;

        return $this;
    }

    public function getIdorder(): ?Order
    {
        return $this->idorder;
    }

    public function setIdorder(?Order $idorder): self
    {
        $this->idorder = $idorder;

        return $this;
    }
}
