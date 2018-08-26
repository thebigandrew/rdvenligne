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
 * Class FermetureDatatable
 *
 * @package RdvBundle\Datatables
 */
class FermetureDatatable extends AbstractDatatable {

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
            'dom' => 't'
        ));

        $this->features->set(array(
        ));

        $this->columnBuilder
                ->add('datedebut', DateTimeColumn::class, array(
                    'title' => 'Date debut'
                ))
                ->add('datefin', DateTimeColumn::class, array(
                    'title' => 'Date fin'
                ))
				->add(null, ActionColumn::class, array(
                    'title' => 'Modifier',
                    'actions' => array(
                        array(
                            'route' => 'addupdate_fermeture',
                            'route_parameters' => array(
                                'id' => 'id'
                            ),
                            'label' => 'Modifier',
                            'attributes' => array(
                                'rel' => 'tooltip',
                                'title' => 'Modification de la fermeture',
                                'class' => 'btn btn-primary btn-xs',
                                'role' => 'button'
                            ),
                        )
                    )
                ))
				->add(null, ActionColumn::class, array(
                    'title' => 'Supprimer',
                    'actions' => array(
                        array(
                            'route' => 'delete_fermeture',
                            'route_parameters' => array(
                                'id' => 'id'
                            ),
                            'label' => 'Supprimer',
                            'attributes' => array(
                                'rel' => 'tooltip',
                                'title' => 'Modification de la fermeture',
                                'class' => 'btn btn-danger btn-xs',
                                'role' => 'button'
                            ),
                        )
                    )
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity() {
        return 'RdvBundle\Entity\Fermeture';
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'fermeture_datatable';
    }

}
