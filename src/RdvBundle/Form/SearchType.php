<?php

// src/AppBundle/Form/RegistrationType.php

namespace RdvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('text', TextType::class, [
                    'attr' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Recherchez un professionnel ...'
                    )
                ])
                ->add('recherche', SubmitType::class, [
                    'label' => 'Recherchez !',
                    'attr' => array('class' => 'btn btn-primary')
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
