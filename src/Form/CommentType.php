<?php

namespace App\Form;

use App\Entity\Blog;
use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Csrf\CsrfToken;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label'=>'Make your comment'
            ])
            ->add('blog', HiddenType::class)
            ->add('send', SubmitType::class)   
        ;
        $builder->get('blog')
            ->addModelTransformer(new CallbackTransformer(
                fn (Blog $blog) =>$blog->getId(),
                fn (Blog $blog) => $blog->getTitle()
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
            'csrf_token_id' => 'add-comment'
        ]);
    }
}
