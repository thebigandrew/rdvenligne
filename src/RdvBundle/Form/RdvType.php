<?php

namespace RdvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use RdvBundle\Entity\TypeRdv;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class RdvType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('creneauxDebut', DateTimeType::class, ['label' => 'Début'])
                ->add('creneauxFin', DateTimeType::class, ['label' => 'Fin'])
                ->add('commentaire', TextareaType::class, ['label' => 'Commentaire'])
                ->add('typeId', EntityType::class, array('class' => TypeRdv::class))
                ->add('Enregistrer', SubmitType::class, [
                    'attr' => array('class' => 'btn btn-info pull-right col-sm-12')
                ]);
                //;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RdvBundle\Entity\Rdv'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rdvbundle_rdv';
    }


}
