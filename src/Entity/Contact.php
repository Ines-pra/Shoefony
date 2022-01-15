<?php
declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Contact")
 * @ORM\Table(name="app_contact")
 */

class Contact 
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
    private $firstname;

    
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $lastname;


    /**
     * @ORM\Column(type="string",length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

     /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

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
    
    public function getFirstName()
    {
        return $this->firstname;
    }

    public function setFirstName(string $firstname)
    {
        return $this->firstname = $firstname;
    }

    
    public function getLastName()
    {
        return $this->lastname;
    }

    public function setLastName(string $lastname)
    {
        return $this->lastname = $lastname;
    }

    
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        return $this->email = $email;
    }

    
    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage(string $message)
    {
        return $this->message = $message;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }
    


}