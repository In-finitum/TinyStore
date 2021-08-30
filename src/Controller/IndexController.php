<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Good;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index_page")
     */
    public function indexpage() {
        $goods = $this->getDoctrine()
            ->getRepository(Good::class)
            ->findAll();
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('views/indexpage.html.twig',
            [
                'categories' => $categories,
                'goods' => $goods,
            ]);
    }
}