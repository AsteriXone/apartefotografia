<?php

namespace App\Controller\Admin;

use App\Entity\Group;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud};
use EasyCorp\Bundle\EasyAdminBundle\Field\{IdField ,TextField};

class GroupCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Group::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', '<i class="form-panel-icon fa-solid fa-people-roof"></i> Grupos')
            ->setPageTitle('new', fn () => 'Registrar Grupo')
            ->setPageTitle('detail', '<i class="form-panel-icon fa-solid fa-people-roof"></i> Detalle Grupo')
            ->setPageTitle('edit', '<i class="form-panel-icon fa-solid fa-people-roof"></i> Editar Grupo')
            //->setDefaultSort(['name' => 'ASC'])
            //->setSearchFields(['name'])
            ->setPaginatorPageSize(20)
            ->setAutofocusSearch()
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_INDEX === $pageName) { // Listado Grupos
            $fields = [
                AssociationField::new('university', 'Universidad'),
                AssociationField::new('specialty', 'Especialidad'),
            ];
        } /* elseif(Crud::PAGE_DETAIL === $pageName) { // Ver
            $fields = [
                IdField::new('id'),
                TextField::new('name', 'Nombre'),
            ];
        } else { // Edit
            $fields = [
                TextField::new('name', 'Nombre'),
            ];
        } */

        return $fields;
    }
}
