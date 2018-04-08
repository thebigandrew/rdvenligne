<?php
// src/AppBundle/Form/RegistrationType.php

namespace RdvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', TextType::class, [
            'label'=>'rdvenligne.first_name',
            'translation_domain' => 'messages'
        ]);
        $builder->add('lastName', TextType::class, [
            'label'=>'rdvenligne.last_name',
            'translation_domain' => 'messages'
        ]);
        $builder->add('telephone', TextType::class, [
            'label'=>'rdvenligne.phone',
            'translation_domain' => 'messages'
        ]);
        $builder->add('dateNaissance', DateType::class, [
            'label'=>'rdvenligne.birth_date',
            'translation_domain' => 'messages'
        ]);
    }

    public function getParent()
 
   {
       return 'FOS\UserBundle\Form\Type\RegistrationFormType';
   }
 
   public function getBlockPrefix()
 
   {
       return 'app_user_registration';
   }
 
   public function getName()
 
   {
       return $this->getBlockPrefix();
   }
}
