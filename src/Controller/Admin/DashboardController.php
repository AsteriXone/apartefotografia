<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;

use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

use App\Entity\User;


class DashboardController extends AbstractDashboardController
{
    private ChartBuilderInterface $chartBuilder;

    public function __construct(ChartBuilderInterface $chartBuilder)
    {
        $this->chartBuilder = $chartBuilder;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $sampleChart = [];

        return $this->render('admin/dashboard.html.twig', [
            //'chart' => $this->createChart($sampleChart),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Aparte Fotografía');
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()

            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
            //->renderSidebarMinimized()

            ->setPaginatorPageSize(20)
            ->showEntityActionsInlined()
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Usuarios');
        yield MenuItem::linkToCrud('Usuarios', 'fa fa-users', User::class);
    }

    public function configureActions(): Actions
    {
        return Actions::new()
            // ...
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            
            ->addBatchAction(Action::BATCH_DELETE)
            ->update(Crud::PAGE_INDEX, Action::BATCH_DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel('Eliminar selección');
            })

            ->add(Crud::PAGE_INDEX, Action::NEW)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-plus')->setLabel(false);
            })

            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setIcon('fa fa-eye')->setLabel(false)->setCssClass('text-primary');
            })

            ->add(Crud::PAGE_INDEX, Action::DELETE)
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setIcon('fa fa-trash')->setLabel(false)->setCssClass('text-danger action-delete');
            })

            ->add(Crud::PAGE_INDEX, Action::EDIT)
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-pencil')->setLabel(false);
            })
            ->add(Crud::PAGE_DETAIL, Action::EDIT)
            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-pencil')->setLabel('Editar');
            })
            ->add(Crud::PAGE_NEW, Action::SAVE_AND_RETURN)
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setIcon('fa fa-save')->setLabel('Guardar');
            })

            ->add(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN)
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setIcon('fa fa-save')->setLabel('Guardar');
            })
            /* 
            public const SAVE_AND_ADD_ANOTHER = 'saveAndAddAnother';
            public const SAVE_AND_CONTINUE = 'saveAndContinue';
            public const SAVE_AND_RETURN = 'saveAndReturn';
            */
        ;
    }

    private function createChart($sampleChart): Chart
    {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        $labels = [];
        $data = [];
        foreach ($sampleChart as $recipe) {
            $labels[] = '#' . $recipe->getId();
        }

        $suggestedMax = 10;
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Valoración',
                    'backgroundColor' => 'rgb(0, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $data,
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'y' => [
                   'suggestedMin' => 0,
                   'suggestedMax' => $suggestedMax + 1,
                ],
            ],
        ]);
        return $chart;
    }

    public function configureAssets(): Assets
    {
        $assets = parent::configureAssets();

        $assets->addWebpackEncoreEntry('admin');

        return $assets;
    }
}
