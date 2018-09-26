<?php
/**
 * Created by PhpStorm.
 * User: asterixone
 * Date: 24/09/2018
 * Time: 21:53
 */

namespace App\Admin;

use App\Form\UserType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BaseAdmin extends AbstractAdmin
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
        $formMapper->add('');
        $formMapper->add('');
        $formMapper->add('');
        $formMapper->add('');
        $formMapper->add('');
        $formMapper->add('');
        $formMapper->add('');
        $formMapper->add('');
        $formMapper->add('');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('');
        $datagridMapper->add('');
        $datagridMapper->add('');
        $datagridMapper->add('');
        $datagridMapper->add('');
        $datagridMapper->add('');
        $datagridMapper->add('');
        $datagridMapper->add('');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('', null, array());
        $listMapper->addIdentifier('', null, array());
        $listMapper->addIdentifier('', null, array());
        $listMapper->addIdentifier('', null, array());
        $listMapper->addIdentifier('', null, array());
        $listMapper->addIdentifier('', null, array());
        $listMapper->addIdentifier('', null, array());
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('')
            ->add('')
            ->add('')
            ->add('')
            ->add('')
            ->add('')
            ->add('')
            ->add('')
            ->add('')
        ;
    }
    public function getExportFields(){
//        $results[]='nombre';
//        $results[]='ape_1';
//        $results[]='ape_2';
//        $results[]='email';
//        $results[]='telefono';

        return $results;
    }
}