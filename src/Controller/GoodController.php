<?php

namespace App\Controller;

use App\Entity\Good;
use App\Form\AddToCartType;
use App\Manager\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GoodController extends AbstractController
{
    /**
     * @Route("/good/{id}", name="good_page")
     */
    public function goodpage(Good $good, Request $request, CartManager $cartManager) {
//        $good = $this->getDoctrine()
//            ->getRepository(Good::class)
//            ->find($id);
//        $category = $good->getIdcategory()->getName();
//        return $this->render('views/goodpage.html.twig',
//            [
//                'good' => $good,
//                'category' => $category,
//            ]);

        $form = $this->createForm(AddToCartType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $goodOrder = $form->getData();
            $goodOrder->setIdgood($good);

            $cart = $cartManager->getCurrentCart();
            $cart
                ->addGoodOrder($goodOrder)
                ->setBuyingdate(new \DateTime());

            $cartManager->save($cart);

            return $this->redirectToRoute('good_page', ['id' => $good->getId()]);
        }

        return $this->render('views/goodpage.html.twig', [
            'good' => $good,
            'form' => $form->createView()
        ]);
    }
}