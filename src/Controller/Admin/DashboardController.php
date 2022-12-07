<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )
    {
        
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(crudControllerFqcn:BlogCrudController::class)->generateUrl();
        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
      
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('OpenMicroscopy Blog');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Go to the site', 'fa fa-undo', 'app_blog');

         yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
             MenuItem::linkToCrud('All articles', 'fas fa-newspaper', Blog::class),
             MenuItem::linkToCrud('Add', 'fas fa-plus', Blog::class)->setAction(Crud::PAGE_NEW),
             
         ]);
         yield MenuItem::subMenu('Medias', 'fas fa-photo-video')->setSubItems([
            MenuItem::linkToCrud('Files', 'fas fa-photo-video', Media::class),
            MenuItem::linkToCrud('Add', 'fas fa-plus', Media::class)->setAction(Crud::PAGE_NEW),
            
        ]);

         yield MenuItem::subMenu('Categories', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class),
            MenuItem::linkToCrud('Add', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW)
         ]);
         yield MenuItem::subMenu('Comments', 'fas fa-comment')->setSubItems([
            MenuItem::linkToCrud('Comments', 'fas fa-list', Comment::class),
            MenuItem::linkToCrud('Add', 'fas fa-plus', Comment::class)->setAction(Crud::PAGE_NEW),
         ]);
         yield MenuItem::subMenu('Users', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('All counts', 'fas fa-user-friends', User::class),
            MenuItem::linkToCrud('Add', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
         ]);
    }
}
