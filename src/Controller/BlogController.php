<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\Category;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\BlogRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(BlogRepository $blogRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'blogs' => $blogRepository->findByIdDesc(),
            'categories' => $categoryRepository->findAll()
        ]);
    }

    #[Route('/blog/article/{slug}', name: 'blog_article_show')]
    public function showArticle(?Blog $blog): Response
    {
        $comment = new Comment($blog);
        $form = $this->createForm(CommentType::class, $comment);


        return $this->render('blog/article.html.twig', [
            'blog' => $blog,
            'form' => $form->createView()
        ]);
    }

    #[Route('/blog/category/{slug}', name: 'blog_category_show')]
    public function showCategory(?Category $category): Response
    {

        return $this->render('blog/category.html.twig', [
            'category' => $category,
        ]);
    }
}
