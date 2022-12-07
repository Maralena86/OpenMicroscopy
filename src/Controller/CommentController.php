<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\BlogRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/ajax/comment', name: 'comment_add')]
    public function add(HttpFoundationRequest $request, BlogRepository $blogRepo, UserRepository $userRepo, CommentRepository $commentRepo): Response
    {
        $commentData = $request->request->all('comment');

        if(!$this->isCsrfTokenValid('add-comment', $commentData['_token'])){
            return $this->json([
                'code' =>'INVALID_CSRF_TOKEN'
            ], Response::HTTP_BAD_REQUEST);
        }
        $blog = $blogRepo->findOneBy(['id' => $commentData['blog']]);

        if(!$blog){
            return $this->json([
                'code' => 'ARTICLE_NOT_FOUND'
                
            ], Response::HTTP_BAD_REQUEST);
        }
        $comment = new Comment($blog);
        $comment->setContent($commentData['content']);
        $comment->setUser($userRepo->findOneBy(['id'=>1]));
        $comment->setCreatedAt(new \DateTime());

        $commentRepo->save($comment, true);
        $html = $this->renderView('comment/index.html.twig', [
            'comment' =>$comment
        ]);

        return $this->json([
            'code' => 'COMMENT_ADDED_SUCCESS', 
            'message' =>$html,
            'numberOfComments' => $commentRepo->count(['blog'=> $blog])

        ]
        );
    }
}
