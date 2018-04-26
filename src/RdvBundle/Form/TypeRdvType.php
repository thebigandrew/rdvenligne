<?php
// src/AppBundle/Form/RegistrationType.php

namespace RdvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class TypeRdvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', TextType::class, ['label'=>'Libellé'])
                ->add('tarif', TextType::class, ['label'=>'Tarif'])
                ->add('duree', TimeType::class, ['label'=>'Durée']);
    }
 
   public function getBlockPrefix()
   {
       return 'app_type_rdv';
   }
 
   public function getName()
   {
       return $this->getBlockPrefix();
   }
}
