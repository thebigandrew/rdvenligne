<?php

namespace RdvBundle\Form;

use RdvBundle\Entity\TypeRdv;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LieuRdvType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nom', TextType::class, ['label' => 'Nom'])
                ->add('adresse', TextareaType::class, ['label' => 'Adresse'])
                ->add('typeRdv', EntityType::class, [
                    'label' => 'Type de RDV',
                    'class' => TypeRdv::class,
                    'query_builder' => function(EntityRepository $er) use($options) {
                        return $er->createQueryBuilder('g')
                                ->andWhere('g.proId = :idPro')
                                ->andWhere('g.enable = TRUE')
                                ->setParameter('idPro', $options['idPro']);
                    },
                    'choice_label' => function ($choiceValue, $key, $value) {
                        return $choiceValue->getType() . ' [' . $choiceValue->getTarif() . '€ | ' . $choiceValue->getDuree()->format('H\hi') . ']';
                    },
                    'multiple' => true,
                    'expanded' => true,
                    'required' => true,
                ])
                ->add('Enregistrer', SubmitType::class, [
                    'attr' => array('class' => 'btn btn-info pull-right col-sm-12')
                ])
        ;
    }

    public function getBlockPrefix() {
        return 'app_lieu_rdv';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'RdvBundle\Entity\LieuRdv',
            'idPro' => null
        ));
    }

}
