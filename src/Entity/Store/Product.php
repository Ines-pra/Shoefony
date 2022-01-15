<?php

namespace App\Entity\Store;

use Doctrine\ORM\Mapping as ORM;

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

      public function getCreatedAt()
      {
          return $this->created_at;
      }
  
      public function setCreatedAt(string $created_at)
      {
          return $this->created_at = $created_at;
      }
 }