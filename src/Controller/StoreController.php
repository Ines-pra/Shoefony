<?php

namespace App\Controller;

use App\Entity\Store\Product;
use App\Entity\Store\Image;
use App\Entity\Store\Brand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        
        $products = $this->em->getRepository(Product::class)->findAll();

        $brands = $this->em->getRepository(Brand::class)->findAll();


        // $product = $this->em->getRepository(Product::class)->find($id);

        // if (!$product) 
        // {
        //     throw new NotFoundHttpException('Le produit d\'id '.$id.'n\'existe pas !');
        // }

        // $colors = $this->colorRepository->findAll();

        // foreach ($colors as $color) {
        //     $product->addColors($color);
        // }

        return $this->render('store/product.html.twig', [
            'title' => "Store",
            'controller_name' => 'StoreController',
            'id' => $id,
            'slug' => $slug,
            'products' => $products,
            'brands' => $brands,
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
        $brands = $this->em->getRepository(Brand::class)->findAll();

        return $this->render('store/product-list.html.twig', [
            'title' => 'Store',
            'products' => $products,
            'images' => $images,
            'brands' => $brands,
        ]);
    }

}
