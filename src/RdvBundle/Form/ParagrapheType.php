<?php

namespace RdvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ParagrapheType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('titre', TextType::class, ['label' => 'titre'])
                ->add('text', TextareaType::class, ['label' => 'texte']);
    }

    public function getBlockPrefix() {
        return 'app_paragrpahe';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }

}
