<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateQuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                    ->add('question')
                    ->add('bonneReponse')
                    ->add('reponse1')
                    ->add('reponse2')
                    ->add('reponse3')
                    ->add('niveau', ChoiceType::class, [
                        'choices'  => [
                            'Facile' => 0,
                            'Moyen' => 1,
                            'Difficile' => 2,
                        ],
                    ])
                    ->add('ajouter', SubmitType::class,[
                        'attr' => [
                            'class' => 'btn btn-success'
                        ]
                    ]);
        ;
    }


    

}