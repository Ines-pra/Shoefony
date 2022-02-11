<?php

namespace App\DataFixtures;

use App\Entity\Store\Brand;
use App\Entity\Store\Color;
use App\Entity\Store\Comment;
use App\Entity\Store\Product;
use App\Entity\Store\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    // private $em;

    // public function __construct(EntityManagerInterface $em)
    // {
    //     $this->em = $em;
    // }

    private const DATA_COMMENTS = [
        [
            'pseudo' => 'User1',
            'message' => 'Comment 1'
        ],
        [
            'pseudo' => 'User2',
            'message' => 'Comment 2'
        ],
        [
            'pseudo' => 'User3',
            'message' => 'Comment 3'
        ],
        [
            'pseudo' => 'User4',
            'message' => 'Comment 4'
        ],
    ];

    private const DATA_BRANDS = [
        ['Adidas'],
        ['Converse'],
        ['Nike'],
        ['Puma'],
        ['LightInTheBox']
    ];

    private const DATA_COLORS = [
        ['Blanc'],
        ['Noir'],
        ['Rouge'],
        ['Bleu'],
        ['Vert'],
        ['Jaune'],
        ['Orange'],
        ['Marron'],
        ['Gris']
    ];

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $this->loadBrands();
        $this->loadColors();
        $this->loadProducts();
        // $this->loadComments();
        
        $manager->flush();
    }
    
    private function loadProducts(): void
    {   
        $listProduct = [
            1 => array (
                "nom" => "Stan Smith",
                "description" => "Adidas",
                "slug" => "shoe-1",
                "bigD" => "Lorem Ipsum...",
            ),
            2 => array(
                "nom" => "Chuck Taylor",
                "description" => "Converse",
                "slug" => "shoe-2",
                "bigD" => "Lorem Ipsum...",
            ),
            3 => array(
                "nom" => "Air Jordan",
                "description" => "Nike",
                "slug" => "shoe-3",
                "bigD" => "Lorem Ipsum...",
            ),
            4 => array(
                "nom" => "Futur Rider",
                "description" => "Puma",
                "slug" => "shoe-4",
                "bigD" => "Lorem Ipsum...",
            ),
            5 => array(
                "nom" => "Nike Red",
                "description" => "Nike",
                "slug" => "shoe-5",
                "bigD" => "Lorem Ipsum...",
            ),
            6 => array(
                "nom" => "Nike Grey",
                "description" => "Nike",
                "slug" => "shoe-6",
                "bigD" => "Lorem Ipsum...",
            ),
            7 => array(
                "nom" => "Stan Smith",
                "description" => "Adidas",
                "slug" => "shoe-7",
                "bigD" => "Lorem Ipsum...",
            ),
            8 => array(
                "nom" => "Jordan",
                "description" => "Nike",
                "slug" => "shoe-8",
                "bigD" => "Lorem Ipsum...",
            ),
            9 => array(
                "nom" => "Nike Colorful",
                "description" => "Nike",
                "slug" => "shoe-9",
                "bigD" => "Lorem Ipsum...",
            ),
            10 => array(
                "nom" => "Air Max 2090",
                "description" => "Nike",
                "slug" => "shoe-10",
                "bigD" => "Lorem Ipsum...",
            ),
            11 => array(
                "nom" => "RS System",
                "description" => "Puma",
                "slug" => "shoe-11",
                "bigD" => "Lorem Ipsum...",
            ),
            12 => array(
                "nom" => "Air Max",
                "description" => "Nike",
                "slug" => "shoe-12",
                "bigD" => "Lorem Ipsum...",
            ),
            13 => array(
                "nom" => "LED",
                "description" => "LightInTheBox",
                "slug" => "shoe-13",
                "bigD" => "Lorem Ipsum...",
            ),
            14 => array(
                "nom" => "Marvel",
                "description" => "Converse",
                "slug" => "shoe-14",
                "bigD" => "Lorem Ipsum...",
            ),
            15=> array(
                "nom" => "Jordan Original",
                "description" => "Nike",
                "slug" => "shoe-15",
                "bigD" => "Lorem Ipsum...",
            ),
            16 => array(
                "nom" => "Nike Yellow",
                "description" => "Nike",
                "slug" => "shoe-16",
                "bigD" => "Lorem Ipsum...",
            ),
            17 => array(
                "nom" => "Nike Croco Green",
                "description" => "Nike",
                "slug" => "shoe-17",
                "bigD" => "Lorem Ipsum...",
            ),
            18 => array(
                "nom" => "Basket White",
                "description" => "Autre",
                "slug" => "shoe-18",
                "bigD" => "Lorem Ipsum...",
            ),
            19 => array(
                "nom" => "Phospho",
                "description" => "Converse",
                "slug" => "shoe-19",
                "bigD" => "Lorem Ipsum...",
            ),
            20 => array(
                "nom" => "Chuck Taylor Red",
                "description" => "Converse",
                "slug" => "shoe-20",
                "bigD" => "Lorem Ipsum...",
            ),

        ];
    
        for ($i = 1; $i <= 20; $i++) 
        {
            $product = new Product();
            $product->setName($listProduct[$i]['nom']);            
            $product->setBrand($this->getRandomEntityReference(Brand::class, self::DATA_BRANDS));            
            $product->setDescription($listProduct[$i]['description']);
            $product->setPrice(mt_rand(10, 100));            
            $product->setSlug($listProduct[$i]['slug']);      
            $product->setBigDescription($listProduct[$i]['bigD']);

            $image = new Image();
            $image->setId($i);
            $image->setUrl('img/products/shoe-'.$i.'.png');
            $image->setAlt('Image '.$i);

            $product->setImage($image);

            for ($j = 0; $j < random_int(0, count(self::DATA_COLORS) -1); $j++) {
                if (random_int(0, 1)) {
                    /** @var Color $color */
                    $color = $this->getReference(Color::class . $j);
                    $product->addColor($color);
                }
            }

            for($k = 0; $k < random_int(0,20); $k++){
                $randomComment = random_int(0, count(self::DATA_COMMENTS)-1);
                $comment = (new Comment())
                    ->setPseudo(self::DATA_COMMENTS[$randomComment]['pseudo'])
                    ->setMessage(self::DATA_COMMENTS[$randomComment]['message'])
                ;
                    
                $product->addComment($comment);
                $this->manager->persist($comment);


        }

            $this->manager->persist($image);
            $this->manager->persist($product);
            sleep(1);
        }
    }

    private function loadBrands(): void {
        foreach (self::DATA_BRANDS as $key => [$name]) {
            $brand = new Brand();
            $brand->setName($name);
            $this->manager->persist($brand);
            $this->addReference(Brand::class . $key, $brand);
        }
    }

    private function loadColors(): void {
        foreach (self::DATA_COLORS as $key => [$name]) {
            $color = new Color();
            $color->setName($name);
            $this->manager->persist($color);
            $this->addReference(Color::class . $key, $color);
        }
    }

    /**
     * @param class-string $entityClass
     * 
     * @return object<class-string>
     */
    private function getRandomEntityReference(string $entityClass, array $data): object {
        return $this->getReference($entityClass . random_int(0, count($data) - 1));
    }

    // private function loadComments(): void {

    //     foreach (self::DATA_COMMENTS as $key => [$message]) {
    //         $comment = new Comment();
    //         $comment->setPseudo('Anonyme');
    //         $comment->setMessage($message);

    //         // $product = new Product...
    //         // $comment->setProductId($product);

    //         $this->manager->persist($comment);
    //         $this->addReference(Comment::class . $key, $comment);
    //         sleep(1);
    //     }
    // }

}