<?php

namespace App\Controller;

use App\Entity\Store\Comment;
use App\Repository\Store\ProductRepository;
use App\Repository\Store\BrandRepository;
use App\Repository\Store\ImageRepository;
use App\Repository\Store\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;

class StoreController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private ProductRepository $productRepository,
        private BrandRepository $brandRepository,
        private ImageRepository $imageRepository,
        private CommentRepository $commentRepository)
    {}

    /** 
     * @Route("/store/product/{id}/details/{slug}",name="store_show_product",methods={"GET","POST"}, requirements={"id"="\d+"})
     */
    public function store(int $id, string $slug, Request $request) : Response
    {
        
        $products = $this->productRepository->findAll();
        $comments = $this->commentRepository->getCommentOfProduct($id);
        $product = $this->productRepository->findOneBySomeField($id);

        $comment = new Comment();
        $comment->setProduct($product);

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($comment);
            $this->em->flush();

            $this->addFlash('success', 'Merci, votre message a bien été pris en compte !');
            // $this->mailer->sendMail($comment);
            // return $this->redirectToRoute('main_comment');
        }

        return $this->render('store/product.html.twig', [
            'controller_name' => 'StoreController',
            'id' => $id,
            'slug' => $slug,
            'products' => $products,
            'brandId' => null,
            'comments' => $comments,
            'form' => $form->createView(),
            // 'ip' => $request->getClientIp(),
        ]);
    }

    /**
     * @Route("/store/product-list",name="store_list_product",methods={"GET"})
     */
    public function product_list(): Response
    {

        $products = $this->productRepository->findAll();
        $images = $this->imageRepository->findAll();
    
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

        $brands = $this->brandRepository->findAll();
       
        return $this->render('store/brands.html.twig', [
            'brands' => $brands,
            'brandId' => $brand,
        ]);
    }


}
