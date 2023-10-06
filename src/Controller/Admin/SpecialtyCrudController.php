<?php

namespace App\Controller\Admin;

use App\Entity\Specialty;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud};
use EasyCorp\Bundle\EasyAdminBundle\Field\{IdField ,TextField};

class SpecialtyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Specialty::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', '<i class="form-panel-icon fa-solid fa-briefcase"></i> Especialidades')
            ->setPageTitle('new', fn () => 'Registrar Especialidad')
            ->setPageTitle('detail', fn (Specialty $specialty) => sprintf('<i class="form-panel-icon fa-solid fa-briefcase"></i> %s', $specialty->getName()))
            ->setPageTitle('edit', fn (Specialty $specialty) => sprintf('<i class="form-panel-icon fa-solid fa-briefcase"></i> Modificar %s', $specialty->getName()))
            ->setDefaultSort(['name' => 'ASC'])
            ->setSearchFields(['name'])
            ->setPaginatorPageSize(20)
            ->setAutofocusSearch()
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_INDEX === $pageName) { // Listado Especialidades
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
