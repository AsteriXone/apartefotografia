<?php
/**
 * Created by PhpStorm.
 * User: asterixone
 * Date: 24/09/2018
 * Time: 21:53
 */

namespace App\Admin;

use App\Entity\Universidad;
use App\Form\UserType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\ChoiceList\ModelChoiceLoader;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;

class GruposAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('universidad')
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
            ->add('universidad')
//            ->add('especialidad')
            ->add('anio')
            ->add('codigoGrupo')
            ->add('isActive', null, array('label' => 'Activo'))
            ->add('isCitasActive', null, array('label' => 'Citas'))
            ->add('isComprasActive', null, array('label' => 'Compras'))
            ->add('isVotosProfe', null, array('label' => 'Votar Profes'))
            ->add('isVotosMuestra', null, array('label' => 'Votar Muestras'))
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
//                ->add('universidad')
                ->add('universidad', ModelType::class)
                ->add('especialidad', ModelType::class)
//                ->add('especialidad')
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
                ->add('universidad')
//                ->add('especialidad')
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