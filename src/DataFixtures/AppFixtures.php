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
        for ($i = 1; $i <= 20; $i++) 
        {
            $product = new Product();
            $product->setName('Product ' . $i);
            $product->setDescription('Description ' . $i);
            $product->setPrice(mt_rand(10, 100));

            $image = new Image();
            $image->setId($i);
            $image->setUrl('img/products/shoe-'.$i.'.jpg');
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