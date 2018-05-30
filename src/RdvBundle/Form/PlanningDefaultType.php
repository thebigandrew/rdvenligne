<?php

namespace RdvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PlanningDefaultType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('heureDebut', TimeType::class, ['label'=>'heure debut'])
                ->add('heureFin', TimeType::class, ['label'=>'heure fin'])
                ->add('planningDays', CollectionType::class, array(
                    'entry_type' => DayPlanningDefaultType::class,
                    'label' => 'Jours de la semaine',
                    'allow_add' => true,/*
                    'prototype' => true,
                    'prototype_name' => 'week_days'*/
                    'entry_options' => [
                        'label_format' => 'week_days.%name%'
                    ]
                ))
                ->add('save', SubmitType::class, [
                    'attr' => ['class' => 'save'],
                    'label' => 'Sauvegarder'
                ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RdvBundle\Entity\PlanningDefault'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rdvbundle_planningdefault';
    }


}
