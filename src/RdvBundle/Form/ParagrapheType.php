<?php

namespace RdvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ParagrapheType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('titre', TextType::class, [
                    'label' => 'titre'
                ])
                ->add('text', TextareaType::class, [
                    'label' => 'texte',
                    'attr' => array('rows' => 10)
                ])
                ->add('Enregistrer', SubmitType::class, [
                    'label' => 'Enregistrer',
                    'attr' => array('class' => 'btn btn-info pull-right col-sm-12')
                ])
        ;
    }

    public function getBlockPrefix() {
        return 'app_paragraphe';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }

}
