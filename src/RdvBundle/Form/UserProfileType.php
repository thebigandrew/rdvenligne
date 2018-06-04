<?php
// src/AppBundle/Form/RegistrationType.php

namespace RdvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('userName', TextType::class, ['label'=>'Login'])
                ->add('firstName', TextType::class, ['label'=>'Prénom'])
                ->add('lastName', TextType::class, ['label'=>'Nom'])
                ->add('email', TextType::class, ['label'=>'Email'])
                ->add('telephone', TextType::class, ['label'=>'Téléphone'])
                ->add('dateNaissance', BirthdayType::class, ['label'=>'Date de naissance']);
    }
 
   public function getBlockPrefix()
   {
       return 'app_user_profile';
   }
 
   public function getName()
   {
       return $this->getBlockPrefix();
   }
}
