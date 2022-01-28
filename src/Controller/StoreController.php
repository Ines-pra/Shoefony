<?php

namespace App\Controller;

use App\Entity\Store\Product;
use App\Entity\Store\Image;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Length;

class StoreController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
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
    public function product_list(): Response
    {
        $products = $this->em->getRepository(Product::class)->findAll();
        $images = $this->em->getRepository(Image::class)->findAll();

        return $this->render('store/product-list.html.twig', [
            'title' => 'Store',
            'products' => $products,
            'images' => $images,
        ]);
    }

    /**
    * @Route("/store/product-detail",name="store_detail_product",methods={"GET"})
     */
    public function product_detail(int $id, string $slug):Response
    {
        return $this->render('store/product-detail.html.twig', [
            'controller_name' => 'Store',
            'id' => $id,
            'slug' => $slug
        ]);
    }
}
