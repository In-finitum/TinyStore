<?php

namespace App\Controller;

use App\Form\CartType;
use App\Manager\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_page")
     */
    public function cartpage(CartManager $cartManager, Request $request) {
        $cart = $cartManager->getCurrentCart();

        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cart->setBuyingdate(new \DateTime());
            $cartManager->save($cart);

            return $this->redirectToRoute('cart_page');
        }

        return $this->render('views/cartpage.html.twig', [
            'cart' => $cart,
            'form' => $form->createView()
        ]);
//        $good = $this->getDoctrine()
//            ->getRepository(Good::class)
//            ->find($id);
//
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $order = new Order();
//        $order->setIduser();
//
//        $goodOrder = new GoodOrder();
//        $goodOrder->setPrice($good->getPrice());
//        $goodOrder->setAmount(1);
//        $goodOrder->setIdgood($good->getId());
//        $goodOrder->setIdorder($order->getId());
//
//        $entityManager->persist($order);
//        $entityManager->persist($goodOrder);
//
//        $entityManager->flush();
//
//        $category = $good->getIdcategory()->getName();
//        return $this->render('views/goodpage.html.twig',
//            [
//                'good' => $good,
//                'category' => $category,
//            ]);
    }
}