<?php

namespace App\Entity\Store;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Store\Image;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Store\ProductRepository")
 * @ORM\Table(name="sto_product")
 */

 class Product 
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
       * @ORM\Column(type="text")
       */
      private $description;

      /**
       * @ORM\Column(type="decimal",precision=10,scale=2)
       */
      private $price;

      /**
       * @ORM\Column(type="datetime")
       */
      private $created_at;

      /**
       * @ORM\Column(type="string",length=255)
       */
      private $bigDescription;

      /**
       * @ORM\Column(type="string",length=255)
       */
      private $slug;


      /**
       * @ORM\OneToOne(targetEntity="App\Entity\Store\Image", cascade={"persist","remove"})
       * @ORM\JoinColumn(nullable=false, name="image_id")
       */

    //   
      
       
      private $image;

      public function __construct()
      {
          $this->created_at = new \DateTime();
      }
      
      public function getId()
      {
          return $this->id;
      }
  
      public function setId(string $id)
      {
          return $this->id = $id;
      }

      public function getName()
      {
          return $this->name;
      }
  
      public function setName(string $name)
      {
          return $this->name = $name;
      }

      public function getDescription()
      {
          return $this->description;
      }
  
      public function setDescription(string $description)
      {
          return $this->description = $description;
      }

      public function getPrice()
      {
          return $this->price;
      }
  
      public function setPrice(string $price)
      {
          return $this->price = $price;
      }

      public function getcreatedAt(): ?\DateTime
      {
          return $this->created_at;
      }
  
      public function setcreatedAt(\DateTime $created_at): self
      {
          $this->created_at = $created_at;
          return $this;
      }

      public function getImage(): ?Image
      {
        return $this->image;
      }

      public function setImage(Image $image): self
      {
          $this->image = $image;
          return $this;
      }

      public function getBigDescription()
      {
          return $this->bigDescription;
      }
  
      public function setBigDescription(string $bigDescription)
      {
          return $this->bigDescription = $bigDescription;
      }

      public function getSlug()
      {
          return $this->slug;
      }
  
      public function setSlug(string $slug)
      {
          return $this->slug = $slug;
      }
 }