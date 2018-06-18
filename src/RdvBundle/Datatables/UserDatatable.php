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
 * Class UserDatatable
 *
 * @package RdvBundle\Datatables
 */
class UserDatatable extends AbstractDatatable
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $this->language->set(array(
            //'cdn_language_by_locale' => true,
            'language' => 'fr_FR'
        ));

        $this->ajax->set(array(
        ));

        $this->options->set(array(
            'classes' => Style::BOOTSTRAP_4_STYLE,
            'individual_filtering' => false,
            'order_cells_top' => true
        ));

        $this->features->set(array(
        ));

        $this->columnBuilder
            ->add('lastname', Column::class, array(
                'title' => 'Nom',
                ))
            ->add('firstname', Column::class, array(
                'title' => 'Prénom',
                ))
            ->add('telephone', Column::class, array(
                'title' => 'Téléphone',
                ))
            ->add('dateNaissance', DateTimeColumn::class, array(
                'title' => 'Date de naissance',
                ))
        ;
        if(array_key_exists('dt-type', $options) && $options['dt-type'] === 'validate-pro')
        {
            $this->columnBuilder
                ->add(null, ActionColumn::class, array(
                    'title' => $this->translator->trans('sg.datatables.actions.title'),
                    'actions' => array(
                        array(
                            'route' => 'rdv_validation_pro',
                            'route_parameters' => array(
                                'id' => 'id'
                            ),
                            'label' => 'Valider',
                            'attributes' => array(
                                'rel' => 'tooltip',
                                'title' => 'Autoriser ce professionnel',
                                'class' => 'btn btn-primary btn-xs',
                                'role' => 'button'
                            ),
                        )
                    )
                ))
            ;
        }

    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'RdvBundle\Entity\User';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'user_datatable';
    }
}
