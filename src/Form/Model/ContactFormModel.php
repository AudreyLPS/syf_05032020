<?php

namespace App\Form\Model;

 class ContactFormModel{
    private $name;
    private $email;
    private $message;

    public function setName         (?string $name)      : void  {    $this->name=$name;     }
    public function setEmail        (?string $email)     : void  {    $this->email=$email;             }
    public function setMessage      (?string $message)   : void  {    $this->message=$message;         }

    public function getName()                            : ?string  {    return $this->name;     }
    public function getEmail()                           : ?string  {    return $this->email;         }
    public function getMessage()                         : ?string  {    return $this->message;       }
    
 }