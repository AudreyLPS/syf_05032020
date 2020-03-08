<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
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
            ->add('email', EmailType::class,[
                'constraints'=> [
                    new NotBlank([
                        'message'=> "L'email est obligatoire"
                    ]),
                    new Email([
                        'message'=> "L'email est incorrect"
                    ]),
                ]
            ])
            ->add('message', TextareaType::class,[
                'constraints'=>[
                    new NotBlank([
                        'message'=> "Le message est obligatoire"
                    ]), 
                    new Length([
                        'min'=> 10, 
                        'minMessage'=> "Le message doit contenir au minimum {{ limit }} caractères",                         
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
        ]);
    }
}
