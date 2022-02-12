<?php

namespace App\Controller;

use App\Entity\Store\Product;
use App\Repository\Store\ProductRepository;
use App\Entity\Store\Image;
use App\Entity\Store\Brand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StoreController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em,
        private ProductRepository $productRepository)
    {
        $this->em = $em;
    }

    /** 
     * @Route("/store/product/{id}/details/{slug}",name="store_show_product",methods={"GET"}, requirements={"id"="\d+"})
     */
    public function store(int $id, string $slug, Request $request) : Response
    {
        
        $products = $this->em->getRepository(Product::class)->findAll();

        return $this->render('store/product.html.twig', [
            'controller_name' => 'StoreController',
            'id' => $id,
            'slug' => $slug,
            'products' => $products,
            'brandId' => null,
            'ip' => $request->getClientIp(),
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
            'brandId' => null,
        ]);
    }

    /** 
     * @Route("/store/product/{brand}",name="store_brand_products",methods={"GET"}, requirements={"id"="\d+"})
     */
    public function product_brand(int $brand) : Response
    {
        $products =  $this->productRepository->getProductOfBrand($brand);
                

        return $this->render('store/product-list.html.twig', [
            'controller_name' => 'StoreController',
            'products' => $products,
            'brandId' => $brand,
        ]);
    }
    
    public function listBrandscontact($brand): Response
    {
        $brands = $this->em->getRepository(Brand::class)->findAll();
       
        return $this->render('store/brands.html.twig', [
            'brands' => $brands,
            'brandId' => $brand,
        ]);
    }


}
