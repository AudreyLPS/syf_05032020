<?php

namespace App\Form\Model;

 class PaysFormModel{

    private $name;
    private $continent;

    public function setName         (?string $name)         : void  {    $this->name=$name;     }
    public function setContinent  (?string $continent)      : void  {    $this->continent=$continent;       }


    public function getName()                               : ?string  {    return $this->name;          }
    public function getContinent()                          : ?string  {    return $this->continent;   }
    
 }