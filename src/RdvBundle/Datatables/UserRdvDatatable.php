<?php

namespace RdvBundle\Datatables;

use Sg\DatatablesBundle\Datatable\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Style;
use Sg\DatatablesBundle\Datatable\Column\Column;
use Sg\DatatablesBundle\Datatable\Column\BooleanColumn;
use Sg\DatatablesBundle\Datatable\Column\ActionColumn;
use Sg\DatatablesBundle\Datatable\Column\MultiselectColumn;
use Sg\DatatablesBundle\Datatable\Column\VirtualColumn;
use Sg\DatatablesBundle\Datatable\Column\DateTimeColumn;
use Sg\DatatablesBundle\Datatable\Column\ImageColumn;
use Sg\DatatablesBundle\Datatable\Filter\TextFilter;
use Sg\DatatablesBundle\Datatable\Filter\NumberFilter;
use Sg\DatatablesBundle\Datatable\Filter\SelectFilter;
use Sg\DatatablesBundle\Datatable\Filter\DateRangeFilter;
use Sg\DatatablesBundle\Datatable\Editable\CombodateEditable;
use Sg\DatatablesBundle\Datatable\Editable\SelectEditable;
use Sg\DatatablesBundle\Datatable\Editable\TextareaEditable;
use Sg\DatatablesBundle\Datatable\Editable\TextEditable;

/**
 * Class RdvDatatable
 *
 * @package RdvBundle\Datatables
 */
class UserRdvDatatable extends AbstractDatatable {

    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array()) {
        $this->language->set(array(
            'cdn_language_by_locale' => true
                //'language' => 'de'
        ));

        $this->ajax->set(array(
        ));

        $this->options->set(array(
            'classes' => Style::BOOTSTRAP_4_STYLE,
            'individual_filtering' => false,
            'order_cells_top' => false,
        ));

        $this->features->set(array(
        ));

        $this->columnBuilder
                ->add('proId.lastname', Column::class, array(
                    'title' => 'Pro. Nom',
                ))
                ->add('proId.firstname', Column::class, array(
                    'title' => 'Pro. Prénom',
                ))
                ->add('proId.telephone', Column::class, array(
                    'title' => 'Pro. Telephone',
                ))
                ->add('creneauxDebut', DateTimeColumn::class, array(
                    'title' => 'Creneaux Debut',
                ))
                ->add('creneauxFin', DateTimeColumn::class, array(
                    'title' => 'Creneaux Fin',
                ))
                ->add('typeId.type', Column::class, array(
                    'title' => 'Type RDV',
                ))
                ->add('validation', BooleanColumn::class, array(
                    'title' => 'Validation',
                ))
                ->add('statut', BooleanColumn::class, array(
                    'title' => 'Statut',
                ))
                ->add(null, ActionColumn::class, array(
                    'title' => 'Actions',
                    'actions' => array(
                        array(
                            'route' => 'client_cancel_rdv',
                            'route_parameters' => array(
                                'id' => 'id'
                            ),
                            'label' => 'Annuler',
                            'attributes' => array(
                                'rel' => 'tooltip',
                                'title' => 'Annuler ce rendez-vous',
                                'class' => 'btn btn-danger btn-xs',
                                'role' => 'button'
                            ),
                        )
                    )
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity() {
        return 'RdvBundle\Entity\Rdv';
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'rdv_datatable';
    }

}
