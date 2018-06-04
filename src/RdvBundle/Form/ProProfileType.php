<?php
// src/AppBundle/Form/RegistrationType.php

namespace RdvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('userName', TextType::class, ['label'=>'Login'])
                ->add('firstName', TextType::class, ['label'=>'Prénom'])
                ->add('lastName', TextType::class, ['label'=>'Nom'])
                ->add('email', TextType::class, ['label'=>'Email'])
                ->add('telephone', TextType::class, ['label'=>'Téléphone'])
                ->add('dateNaissance', DateType::class, ['label'=>'Date de naissance'])
                ->add('metier', TextType::class, ['label'=>'Métier']);
    }
 
   public function getBlockPrefix()
   {
       return 'app_pro_profile';
   }
 
   public function getName()
   {
       return $this->getBlockPrefix();
   }
}
