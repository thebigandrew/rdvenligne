<?php

namespace RdvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ParagrapheDeleteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('Delete', SubmitType::class, [
            'label' => 'Supprimer',
            'attr' => array('class' => 'btn btn-danger pull-right col-sm-12')
        ]);
    }

    public function getBlockPrefix() {
        return 'app_paragraphe';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }

}
