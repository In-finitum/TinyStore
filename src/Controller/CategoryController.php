<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="category_page")
     */
    public function categorypage(int $id) {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->find($id);
        $goods = $category->getGoods();
        return $this->render('views/category.html.twig',
            [
                'category' => $category,
                'goods' => $goods,
            ]);
    }
}