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

class UserAdmin extends AbstractAdmin
{
    protected $datagridValues = [
        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'user.fullname',
    ];

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
//        $collection->remove('edit');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('email', EmailType::class);
        $formMapper->add('username', TextType::class);
        $formMapper->add('ape_1', TextType::class);
        $formMapper->add('ape_2', TextType::class, array('required' => false));
        $formMapper->add('direccion', TextType::class);
        $formMapper->add('telefono', TextType::class);
        $formMapper->add('titulacion', TextType::class, array('required' => false));
        $formMapper->add('mencion', TextType::class, array('required' => false));

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('email');
        $datagridMapper->add('username');
        $datagridMapper->add('telefono');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('fullname', null, array('sortable'=>true, 'label' => 'Usuario'));
        $listMapper->addIdentifier('email', null, array('label' => 'Correo'));
        $listMapper->addIdentifier('onlyDate', null, array('sortable'=>true, 'label' => 'Registro'));
        $listMapper->addIdentifier('direccion', null, array('label' => 'Dirección'));
        $listMapper->addIdentifier('telefono', null, array('label' => 'Teléfono'));
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('username')
            ->add('roles')
            ->add('password')
            ->add('email')
            ->add('direccion')
            ->add('telefono')
        ;
    }
    public function getExportFields(){
        $results[]='nombre';
        $results[]='ape_1';
        $results[]='ape_2';
        $results[]='email';
        $results[]='telefono';

        return $results;
    }
}