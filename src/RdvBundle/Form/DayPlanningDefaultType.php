<?php

namespace RdvBundle\Form;

use RdvBundle\Entity\LieuRdv;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DayPlanningDefaultType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('jourSemaine', HiddenType::class, ['label'=>'jour semaine'])
                ->add('activeDay', CheckboxType::class, ['label'=>'Ce jour est ouvré', 'required' => false])
                ->add('heureDebut', TimeType::class, ['label'=>'heure debut', 'required' => false])
                ->add('heureFin', TimeType::class, ['label'=>'heure fin', 'required' => false])
                ->add('nbcreneaux', IntegerType::class, ['label'=>'Nb creneaux', 'required' => false])
                ->add('lieu', EntityType::class, [
                    'label' => 'Lieu',
                    'class' => LieuRdv::class,
                    'choice_label' => 'nom',
                    'required' => false,
                    'placeholder' => 'Selectionner un lieu',
                    'empty_data' => null,
                    'query_builder' => function(EntityRepository $er) use($options) {
                        return $er->createQueryBuilder('l')
                                ->andWhere('l.proId = :idPro')
                                ->setParameter('idPro', $options['idPro']);
                    }
                ]);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RdvBundle\Entity\DayPlanningDefault',
            'idPro' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'rdvbundle_dayplanningdefault';
    }


}
