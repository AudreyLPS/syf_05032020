<?php

namespace App\Form\Model;

 class EtapeFormModel{

    private $name;
    private $description;
    private $duration;
    private $image;
    private $pays;

    public function setName         (?string $name)         : void  {    $this->name=$name;     }
    public function setDescription  (?string $description)  : void  {    $this->description=$description;       }
    public function setDuration     (?string $duration)     : void  {    $this->duration=$duration;             }
    public function setImage        (?string $image)        : void  {    $this->image=$image;         }
    public function setPays         (?string $pays)         : void  {    $this->pays=$pays;         }


    public function getName()                               : ?string  {    return $this->name;          }
    public function getDescription()                        : ?string  {    return $this->description;   }
    public function getDuration ()                          : ?integer {    return $this->duration;      }
    public function getImage()                              : ?string  {    return $this->image;         }
    public function getPays()                               : ?string  {    return $this->pays;          }
    
 }