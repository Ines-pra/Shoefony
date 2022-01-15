<?php

namespace App\Controller;

use App\Entity\Store\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

class StoreController extends AbstractController 
{
     /** 
     * @Route("/store/product/{id}/details/{slug}",name="store_show_product",methods={"GET"}, requirements={"id"="\d+"})
     */

    public function store(int $id, string $slug, Request $request) : Response
    {
        return $this->render('store/product.html.twig', [
            'title' => "Store",
            'controller_name' => 'StoreController',
            'id' => $id,
            'slug' => $slug,
            'ip' => $request->getClientIp()
        ]);
    }

    /** 
     * @Route("/store/product-list",name="store_list_product",methods={"GET"})
     */

    public function product_list() : Response
    {
        return $this->render('store/product-list.html.twig', [
            'title' => "Product list",
           
        ]);
    }

    /** 
     * @Route("/store/product-detail",name="store_detail_product",methods={"GET"})
     */

    public function product_detail() : Response
    {
        return $this->render('store/product-detail.html.twig', [
            'title' => "Product detail",
           
        ]);
    }

   
}
