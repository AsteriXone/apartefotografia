<?php
/**
 * Created by PhpStorm.
 * User: asterixone
 * Date: 24/09/2018
 * Time: 21:53
 */

namespace App\Admin;

use App\Entity\Colegio;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ColegioAdmin extends AbstractAdmin
{

//    protected $datagridValues = [
//        // name of the ordered field (default = the model's id field, if any)
//        '_sort_by' => 'user.fullname',
//    ];

    protected function configureRoutes(RouteCollection $collection)
    {
//        $collection->remove('create');
//        $collection->remove('edit');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('nombre');
//        $formMapper->add('grupos');
//        $formMapper->add('');
//        $formMapper->add('');
//        $formMapper->add('');
//        $formMapper->add('');
//        $formMapper->add('');
//        $formMapper->add('');
//        $formMapper->add('');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('nombre');
//        $datagridMapper->add('grupos');
//        $datagridMapper->add('');
//        $datagridMapper->add('');
//        $datagridMapper->add('');
//        $datagridMapper->add('');
//        $datagridMapper->add('');
//        $datagridMapper->add('');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('nombre', null, array('label'=>'Nombre'));
//        $listMapper->addIdentifier('grupos', null, array());
        $listMapper->add('_action', null, array(
        'actions' => array(
            'show' => array(),
            'edit' => array(),
            'delete' => array(),
        )));
//        $listMapper->addIdentifier('', null, array());
//        $listMapper->addIdentifier('', null, array());
//        $listMapper->addIdentifier('', null, array());
//        $listMapper->addIdentifier('', null, array());
//        $listMapper->addIdentifier('', null, array());
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nombre')
//            ->add('')
//            ->add('')
//            ->add('')
//            ->add('')
//            ->add('')
//            ->add('')
//            ->add('')
//            ->add('')
        ;
    }
    public function getExportFields(){
        $results[]='nombre';
//        $results[]='ape_1';
//        $results[]='ape_2';
//        $results[]='email';
//        $results[]='telefono';

        return $results;
    }
}