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
    }
}