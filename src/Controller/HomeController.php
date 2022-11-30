<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_front_home')]
    public function index(): Response
    {
        return $this->render('front/home.html.twig');
    }
    #[Route('/publications', name: 'app_front_publications')]
    public function showPublications(): Response
    {
        return $this->render('front/publications.html.twig');
    }
    #[Route('/members', name: 'app_front_members')]
    public function showMembers(): Response
    {
        return $this->render('front/members.html.twig');
    }
    #[Route('/database', name: 'app_front_database')]
    public function showDatabase(): Response
    {
        return $this->render('front/database.html.twig');
    }
}
