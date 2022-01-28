<?php

namespace App\DataFixtures;

use App\Entity\Store\Product;
use App\Entity\Store\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        // $this->loadImage();
        $this->loadProducts();
        
        $manager->flush();
    }
    
    private function loadProducts(): void
    {   
        $listProduct = [
            1 => array (
                "nom" => "Stan Smith",
                "description" => "Adidas",
            ),
            2 => array(
                "nom" => "Chuck Taylor",
                "description" => "Converse",
            ),
            3 => array(
                "nom" => "Air Jordan",
                "description" => "Nike",
            ),
            4 => array(
                "nom" => "Futur Rider",
                "description" => "Puma",
            ),
            5 => array(
                "nom" => "Nike Red",
                "description" => "Nike",
            ),
            6 => array(
                "nom" => "Nike Grey",
                "description" => "Nike",
            ),
            7 => array(
                "nom" => "Stan Smith",
                "description" => "Adidas",
            ),
            8 => array(
                "nom" => "Jordan",
                "description" => "Nike",
            ),
            9 => array(
                "nom" => "Nike Colorful",
                "description" => "Nike",
            ),
            10 => array(
                "nom" => "Air Max 2090",
                "description" => "Nike",
            ),
            11 => array(
                "nom" => "RS System",
                "description" => "Puma",
            ),
            12 => array(
                "nom" => "Air Max",
                "description" => "Nike",
            ),
            13 => array(
                "nom" => "LED",
                "description" => "LightInTheBox",
            ),
            14 => array(
                "nom" => "Marvel",
                "description" => "Converse",
            ),
            15=> array(
                "nom" => "Jordan Original",
                "description" => "Nike",
            ),
            16 => array(
                "nom" => "Nike Yellow",
                "description" => "Nike",
            ),
            17 => array(
                "nom" => "Nike Croco Green",
                "description" => "Nike",
            ),
            18 => array(
                "nom" => "Basket White",
                "description" => "Autre",
            ),
            19 => array(
                "nom" => "Phospho",
                "description" => "Converse",
            ),
            20 => array(
                "nom" => "Chuck Taylor Red",
                "description" => "Converse",
            ),

        ];
    
        for ($i = 1; $i <= 20; $i++) 
        {
            $product = new Product();
            $product->setName($listProduct[$i]['nom']);
            $product->setDescription($listProduct[$i]['description']);
            $product->setPrice(mt_rand(10, 100));

            $image = new Image();
            $image->setId($i);
            $image->setUrl('img/products/shoe-'.$i.'.png');
            $image->setAlt('Image '.$i);

            $product->setImage($image);

            $this->manager->persist($image);
            $this->manager->persist($product);
        }
    }

    // private function loadImage() : void 
    // {
    //     for($i = 1; $i <= 20; $i++)
    //     {
    //         $image = new Image();
    //         $image->setId($i);
    //         $image->setUrl('img/products/shoe-'.$i.'.jpg');
    //         $image->setAlt('Image '.$i);
    //         $this->manager->persist($image);
    //     }
    // }
}