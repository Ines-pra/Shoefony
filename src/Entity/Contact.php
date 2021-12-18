<?php
declare(strict_types=1);

namespace App\Entity;

class Contact 
{
    private ?string $firstname = null;
    private ?string $lastname = null;
    private ?string $email = null;
    private ?string $message = null;

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
    


}