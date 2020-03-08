<?php

namespace App\EventSubscriber\Entity;

use App\Entity\Etape;
use Doctrine\ORM\Events;
use App\Service\FileService;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

 class EtapeEventSubscriber implements EventSubscriber{

     private $slugger; 

     public function __construct(SluggerInterface $slugger, FileService $fileService)
     {
         $this->slugger = $slugger;
         $this->fileService = $fileService;
     }

     public function getSubscribedEvents(){
        return[
            Events::prePersist,
            Events::postLoad,
            Events::preUpdate,
            Events::preRemove
        ];
     }
     public function preRemove(LifecycleEventArgs $args):void{
        if($args->getObject() instanceof Etape){
            $etape=$args->getObject();

            //génere une erreur lorsque l'image n'existe pas
            //$this->fileService->delete($etape->prevImage,'img\etape');

        }
    }
     public function prePersist( LifecycleEventArgs $event ):void{
        if($event->getObject() instanceof Etape ) {
            $etape=$event->getObject();
            //$etape->setSlug($this->slugger->slug($etape->getName())->lower());

        if($etape->getImage() instanceof UploadedFile){
                $this->fileService->upload($etape->getImage(),'img\etape');

                $etape->setImage($this->fileService->getFileName());
            }
        }
    }

    public function postLoad(LifecycleEventArgs $args):void{
        if($args->getObject() instanceof Etape){
        
            $etape = $args->getObject();
            $etape->prevImage = $etape->getImage();
        }
    }

    public function preUpdate(LifecycleEventArgs $args):void{
        if($args->getObject() instanceof Etape){
            $etape = $args->getObject();
            if($etape->getImage() instanceof UploadedFile){
                $this->fileService->upload($etape->getImage(),'img\etape');
                $etape->setImage($this->fileService->getFileName());

                $this->fileService->delete($etape->prevImage,'img\etape');
            }

            else{
                $etape->setImage($etape->prevImage);
            }
        }
    }
 }