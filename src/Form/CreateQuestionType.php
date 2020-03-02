<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
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
                    ->add('niveau')
                    
        ;
    }


    

}