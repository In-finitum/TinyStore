<?php

namespace App\Factory;

use App\Entity\Order;
use App\Entity\GoodOrder;
use App\Entity\Good;

/**
 * Class OrderFactory
 * @package App\Factory
 */
class OrderFactory
{
    /**
     * Creates an order.
     *
     * @return Order
     */
    public function create(): Order
    {
        $order = new Order();
        $order
            ->setStatus(Order::STATUS_CART)
            ->setAddingdate(new \DateTime())
            ->setBuyingdate(new \DateTime());

        return $order;
    }

    /**
     * Creates an item for a product.
     *
     * @param Good $good
     *
     * @return GoodOrder
     */
    public function createItem(Good $good): GoodOrder
    {
        $goodOrder = new GoodOrder();
        $goodOrder->setIdgood($good);
        $goodOrder->setAmount(1);

        return $goodOrder;
    }
}