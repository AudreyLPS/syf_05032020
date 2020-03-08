<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\Etape;
use App\Form\Model\EtapeFormModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\EventSubscriber\Form\EtapeFormSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EtapeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'constraints'=> [
                    new NotBlank([
                        'message'=> "Le nom est obligatoire"
                    ]), 
                    new Length([
                        'min'=> 2, 
                        'max'=> 25, 
                        'minMessage'=> "Le nom doit contenir au minimum {{ limit }} caractères", 
                        'maxMessage'=> "Le nom doit contenir au maximum {{ limit }} caractères", 
                        
                    ])
                ]
            ])
            ->add('description', TextareaType::class,[
                'constraints'=> [
                    new NotBlank([
                        'message'=> "La description de l'etape est obligatoire"
                    ])
                ]
            ])
            ->add('duration',NumberType::class,[
                'constraints'=> [
                    new NotBlank([
                        'message'=> "La durée du produit est obligatoire"
                    ]),
                    new Positive([
                        'message'=> "La durée ne peut pas être négatif"
                    ])
                ]
            ])
            ->add('pays', EntityType::class, [
                'class'=>Pays::class,
                'choice_label'=>'name',
                'placeholder'=>'',
                'constraints'=>[
                    new NotBlank([
                        'message'=>'La pays est obligatoire'
                    ])
                ]
            ])
        ;
        $builder->addEventSubscriber(new EtapeFormSubscriber());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etape::class
        ]);
    }
}
