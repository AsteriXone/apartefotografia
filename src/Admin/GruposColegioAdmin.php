<?php
/**
 * Created by PhpStorm.
 * User: asterixone
 * Date: 24/09/2018
 * Time: 21:53
 */

namespace App\Admin;

use App\Entity\Colegio;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;

class GruposColegioAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('colegio')
//            ->add('especialidad')
            ->add('anio')
            ->add('codigoGrupo');
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('colegio', null, array('sortable'=>true, 'label' => 'Grupo Colegio'))
            ->add('anio')
            ->add('codigoGrupo', null, array('editable' => true))
            ->add('isActive', null, array('label' => 'Activo', 'editable' => true))
            ->add('isCitasActive', null, array('label' => 'Citas', 'editable' => true))
            ->add('isComprasActive', null, array('label' => 'Compras', 'editable' => true))
            ->add('isVotosProfe', null, array('label' => 'Votar Profes', 'editable' => true))
            ->add('isVotosMuestra', null, array('label' => 'Votar Muestras','editable' => true))
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ));
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Datos Grupo', ['class' => 'col-md-9'])
                ->add('colegio', ModelType::class, [
                'class' => Colegio::class
            ])
                ->add('anio')
                ->add('codigoGrupo')
            ->end()
            ->with('Gestión', ['class' => 'col-md-3'])
                ->add('isActive', null, array('label' => 'Activo'))
                ->add('isCitasActive', null, array('label' => 'Pedir Citas'))
                ->add('isComprasActive', null, array('label' => 'Hacer Compras'))
                ->add('isVotosProfe', null, array('label' => 'Votar Profes'))
                ->add('isVotosMuestra', null, array('label' => 'Votar Muestras'))
            ->end();
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Grupo', ['class' => 'col-md-9'])
                ->add('colegio')
                ->add('anio')
                ->add('codigoGrupo')
            ->end()
            ->with('Gestión', ['class' => 'col-md-3'])
                ->add('isActive', null, array('label' => 'Activo'))
                ->add('isCitasActive', null, array('label' => 'Pedir Citas'))
                ->add('isComprasActive', null, array('label' => 'Hacer Compras'))
                ->add('isVotosProfe', null, array('label' => 'Votar Profes'))
                ->add('isVotosMuestra', null, array('label' => 'Votar Muestras'))
            ->end();
    }
}