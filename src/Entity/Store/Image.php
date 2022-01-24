<?php

namespace App\Entity\Store;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Store\ImageRepository")
 * @ORM\Table(name="sto_image_id")
 */

 class Image 
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
    private $url;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $alt;

    public function getId()
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        return $this->id = $id;
    }

    public function getUrl() 
    {
        return $this->url;
    }

    public function setUrl(string $url) 
    {
        return $this->url = $url;
    }

    public function getAlt() 
    {
        return $this->alt;
    }

    public function setAlt(string $alt) {
        return $this->alt = $alt;
    }

 }