<?php

namespace App\Controller\Admin;

use App\Entity\User;

use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud, KeyValueStore};
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{IdField, EmailField, TextField, ChoiceField};
use Symfony\Component\Form\Extension\Core\Type\{PasswordType, RepeatedType};
use Symfony\Component\Form\{FormBuilderInterface, FormEvent, FormEvents};
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;

use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ArrayFilter;

class UserCrudController extends AbstractCrudController
{
    public function __construct(
        public UserPasswordHasherInterface $userPasswordHasher
    ) {

    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', '<i class="form-panel-icon fa fa-users"></i> Listado Usuarios')
            ->setPageTitle('new', fn () => 'Registrar Usuario')
            ->setPageTitle('detail', fn (User $user) => sprintf('<i class="form-panel-icon fa fa-user"></i> %s', $user->getApellidos() . ', ' . $user->getName()))
            ->setPageTitle('edit', fn (User $user) => sprintf('<i class="form-panel-icon fa fa-user"></i> %s', $user->getApellidos() . ', ' . $user->getName()))
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_INDEX === $pageName) { // Listado Usuarios
            $fields = [
                TextField::new('name', 'Nombre'),
                TextField::new('apellidos', 'Apellidos'),
                EmailField::new('email'),
                ChoiceField::new('roles')
                    ->setTemplatePath('admin/field/roles.html.twig')
            ];
        } elseif(Crud::PAGE_DETAIL === $pageName) { // Ver
            $fields = [
                /* UrlField::new('email', '')->setColumns('col-sm-6')
                ->setTemplatePath('admin/field/url.html.twig'), */
                TextField::new('name', 'Nombre'),
                TextField::new('surname_1', 'Apellido 1')->setColumns('col-sm-6'),
                TextField::new('surname_2', 'Apellido 2')->setColumns('col-sm-6'),
                EmailField::new('email'),
                ChoiceField::new('roles')
                ->allowMultipleChoices()
                ->setChoices([
                    'Super Admin' => 'ROLE_SUPER_ADMIN',
                    'Admin' => 'ROLE_ADMIN',
                    'Académico' => 'ROLE_ACADEMICA',
                    'Social' => 'ROLE_SOCIAL',
                ])
                ->renderAsBadges([
                        'ROLE_SUPER_ADMIN' => 'danger',
                        'ROLE_ADMIN' => 'danger',
                        'ROLE_ACADEMICA' => 'success',
                        'ROLE_SOCIAL' => 'primary',
                    ]
                ),
            ];
            
            $password = TextField::new('password')
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type' => PasswordType::class,
                    'first_options' => ['label' => 'Password'],
                    'second_options' => ['label' => 'Confirmar Password'],
                    'mapped' => false,
                ])
                ->setRequired($pageName === Crud::PAGE_NEW)
                ->onlyOnForms()
                ;
            $fields[] = $password;
        } else { // Edit
            $fields = [
                TextField::new('name', 'Nombre'),
                TextField::new('surname_1', 'Apellido 1')->setColumns('col-sm-6'),
                TextField::new('surname_2', 'Apellido 2')->setColumns('col-sm-6'),
                FormField::addPanel(),
                EmailField::new('email'),
                FormField::addPanel(),
                ChoiceField::new('roles')
                ->allowMultipleChoices()
                ->setChoices([
                    'Super Admin' => 'ROLE_SUPER_ADMIN',
                    'Admin' => 'ROLE_ADMIN',
                    'Académico' => 'ROLE_ACADEMICA',
                    'Social' => 'ROLE_SOCIAL',
                ]),
                FormField::addPanel(),
            ];
            
            $password = TextField::new('password')
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type' => PasswordType::class,
                    'first_options' => ['label' => 'Password'],
                    'second_options' => ['label' => 'Confirmar Password'],
                    'mapped' => false,
                ])
                ->setRequired($pageName === Crud::PAGE_NEW)
                ->onlyOnForms()
                ;
            $fields[] = $password;
        }
        

        return $fields;
    }

    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    private function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
        return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->hashPassword());
    }

    private function hashPassword() {
        return function($event) {
            $form = $event->getForm();
            if (!$form->isValid()) {
                return;
            }
            $password = $form->get('password')->getData();
            if ($password === null) {
                return;
            }

            $hash = $this->userPasswordHasher->hashPassword($form->getData(), $password);
            $form->getData()->setPassword($hash);
        };
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        // SELECT * FROM `user` WHERE `roles` LIKE '%ROLE_ADMIN%' 
        return parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters)
            ->andWhere('entity.roles NOT LIKE :roles')
            ->andWhere('entity.roles NOT LIKE :super_roles')
            ->setParameter('roles', '%ROLE_ADMIN%')
            ->setParameter('super_roles', '%ROLE_SUPER_ADMIN%');;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return parent::configureFilters($filters)
            ->add('name')
            ->add(ArrayFilter::new('roles')->setChoices([
                'Académico' => 'ROLE_ACADEMICA',
                'Social' => 'ROLE_SOCIAL',
                ])
                ->canSelectMultiple(true)
                //->renderExpanded(true)
            );
    }
}
