<?php

namespace App\Controller\Admin;

use App\Entity\University;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud};
use EasyCorp\Bundle\EasyAdminBundle\Field\{IdField ,TextField};


class UniversityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return University::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', '<i class="form-panel-icon fa-solid fa-building-columns"></i> Universidades')
            ->setPageTitle('new', fn () => 'Registrar Universidad')
            ->setPageTitle('detail', fn (University $university) => sprintf('<i class="form-panel-icon fa-solid fa-building-columns"></i> %s', $university->getName()))
            ->setPageTitle('edit', fn (University $university) => sprintf('<i class="form-panel-icon fa-solid fa-building-columns"></i> Modificar %s', $university->getName()))
            ->setDefaultSort(['name' => 'ASC'])
            ->setSearchFields(['name'])
            ->setPaginatorPageSize(20)
            ->setAutofocusSearch()
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_INDEX === $pageName) { // Listado Universidades
            $fields = [
                TextField::new('name', 'Nombre'),
            ];
        } elseif(Crud::PAGE_DETAIL === $pageName) { // Ver
            $fields = [
                IdField::new('id'),
                TextField::new('name', 'Nombre'),
            ];
        } else { // Edit
            $fields = [
                TextField::new('name', 'Nombre'),
            ];
        }

        return $fields;
    }
}
