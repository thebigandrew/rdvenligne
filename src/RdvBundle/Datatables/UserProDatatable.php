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
class UserProDatatable extends AbstractDatatable {

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
                ->add('userId.lastname', Column::class, array(
                    'title' => 'User. Nom',
                    'default_content' => ''
                ))
                ->add('userId.firstname', Column::class, array(
                    'title' => 'User. Prénom',
                    'default_content' => ''
                ))
                ->add('userId.telephone', Column::class, array(
                    'title' => 'User. Telephone',
                    'default_content' => ''
                ))
                ->add('creneauxDebut', DateTimeColumn::class, array(
                    'title' => 'Dernier Creneaux Debut',
                ))
                ->add('creneauxFin', DateTimeColumn::class, array(
                    'title' => 'Dernier Creneaux Fin',
                ))
                ->add('statut', Column::class, array(
                    'visible' => false
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
                        ),
                        array(
                            'route' => 'client_confirm_rdv',
                            'route_parameters' => array(
                                'id' => 'id'
                            ),
                            'label' => 'Confirmer',
                            'attributes' => array(
                                'rel' => 'tooltip',
                                'title' => 'Confirmer ce rendez-vous',
                                'class' => 'btn btn-danger btn-xs',
                                'role' => 'button'
                            ),
                             'render_if' => function ($row) {
                                dump( $row );
                                return $row['statut'] === false;
                            }
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
        return 'user_pro_datatable';
    }

}
