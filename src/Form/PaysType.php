<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\Continent;
use App\Form\Model\PaysFormModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PaysType extends AbstractType
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
            ->add('continent', EntityType::class, [
                'class'=>Continent::class,
                'choice_label'=>'name',
                'placeholder'=>'',
                'constraints'=>[
                    new NotBlank([
                        'message'=>'La continent est obligatoire'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pays::class,
        ]);
    }
}
