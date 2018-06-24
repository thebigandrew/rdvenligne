<?php

namespace RdvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
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
        $u = $options['user'];
        $builder->add('creneauxDebut', DateTimeType::class, ['label' => 'Début', 'years' => range(date('Y'), date('Y') + 1),])
                ->add('creneauxFin', DateTimeType::class, ['label' => 'Fin', 'years' => range(date('Y'), date('Y') + 1),])
                ->add('commentaire', TextareaType::class, ['label' => 'Commentaire'])
                ->add('typeId', EntityType::class, array('label' => 'Type de RDV', 'class' => 'RdvBundle:TypeRdv', 'choice_label' => 'type', 'query_builder' => function(EntityRepository $er) use ($u){
                                                                                                                                          return $er->createQueryBuilder('t')
                                                                                                                                                    ->where('t.proId = :user')
                                                                                                                                                    ->setParameter('user', $u);
                                                                                                                                      }))
                ->add('Enregistrer', SubmitType::class, [
                    'attr' => array('class' => 'btn btn-info pull-right col-sm-12')
                ]);
                //;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RdvBundle\Entity\Rdv',
            'user' => null,
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
