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

class LieuRdvDeleteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('Delete', SubmitType::class, [
            'label' => 'Supprimer',
            'attr' => array('class' => 'btn btn-danger pull-right col-sm-12')
        ]);
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
