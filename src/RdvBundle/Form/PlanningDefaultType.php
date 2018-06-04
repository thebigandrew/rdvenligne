<?php

namespace RdvBundle\Form;

use RdvBundle\Entity\DayPlanningDefault;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PlanningDefaultType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('planningDays', CollectionType::class, array(
                    'entry_type' => DayPlanningDefaultType::class,
                    'label' => 'Semaine type',
                    'allow_add' => true,
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
