<?php

namespace App\Entity\Store;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Store\Product;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Store\BrandRepository")
 * @ORM\Table(name="sto_brand")
 */

 class Brand 
 {
     /**
     * @ORM\Id()
    * @ORM\GeneratedValue() 
    * @ORM\Column(type="integer")
    */
     private $id;

     /**
     * @ORM\Column(type="string",length=255)
     */
     private $name;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="brand", orphanRemoval=true)
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setBrand($this);
        }
        return $this;
    }

    public function removeProduct(Product $product): self 
    {
        if($this->products->contains($product)){
            $this->products->removeElement($product);
            if ($product->getBrand() === $this) {
                $product->setBrand(null);
            }
        }

        return $this;
    }
            
    public function getId() : ?int
    {
        return $this->id;
    }

    public function getName() : ?string
    {
        return $this->name;
    }

    public function setName(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

 }