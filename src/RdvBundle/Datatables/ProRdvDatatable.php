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
class ProRdvDatatable extends AbstractDatatable {
    
    public function getLineFormatter()
    {
        $formatter = function($row) {
            if( $row['userId'] === null)
            {
                $row['ClientDescription'] = $row['commentaire'];
            }
            else
            {
                $row['ClientDescription'] = $row['userId']['firstname'] . ' ' . $row['userId']['lastname'] . ' - ' . $row['userId']['telephone'];
            }
            
            return $row;
        };

        return $formatter;
    }

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
                ->add('ClientDescription', VirtualColumn::class, array(
                    'title' => 'Client/Description',
                    'searchable' => false,
                    'orderable' => false,/*
                    'order_column' => 'createdBy.username', // use the 'createdBy.username' column for ordering
                    'search_column' => 'createdBy.username', // use the 'createdBy.username' column for searching
                     */
                ))
                ->add('userId.lastname', Column::class, array(
                    'title' => 'User. Nom',
                    'visible' => false,
                    'default_content' => ''
                ))
                ->add('userId.firstname', Column::class, array(
                    'title' => 'User. Prénom',
                    'visible' => false,
                    'default_content' => ''
                ))
                ->add('userId.telephone', Column::class, array(
                    'title' => 'User. Telephone',
                    'visible' => false,
                    'default_content' => ''
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
                    'true_label' => 'Oui',
                    'false_label' => 'Non'
                ))
                ->add('statut', BooleanColumn::class, array(
                    'title' => 'Statut',
                    'visible' => false
                ))
                ->add('commentaire', Column::class, array(
                    'visible' => false,
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
        return 'pro_rdv_datatable';
    }

}
