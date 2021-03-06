<?php

// src/AppBundle/Form/RegistrationType.php

namespace RdvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TypeRdvType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('type', TextType::class, ['label' => 'Libellé'])
                ->add('tarif', NumberType::class, [
                    'label' => 'Tarif',
                    'scale' => 2,
                    'attr' => array('step' => '0.01')
                ])
                ->add('duree', TimeType::class, ['label' => 'Durée'])
                ->add('Enregistrer', SubmitType::class, [
                    'attr' => array('class' => 'btn btn-info pull-right col-sm-12')
                ])
        ;
    }

    public function getBlockPrefix() {
        return 'app_type_rdv';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }

}
