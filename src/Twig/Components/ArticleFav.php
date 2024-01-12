<?php

namespace App\Twig\Components;

use App\Entity\Article;
use App\Entity\User;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class ArticleFav
{
    use DefaultActionTrait;

    #[LiveProp]
    public Article $article;

    public function __construct(
        private ArticleRepository $articleRepository,
        private Security $security,
        private EntityManagerInterface $entityManager
    ) {}

    #[LiveAction]
    public function toggle(): void
    {
        /** @var User $user */
        $user = $this->security->getUser();
        if ($user->getArticles()->contains($this->article)) {
            $user->removeArticle($this->article);
        }else {
            $user->addArticle($this->article);
        }
        $this->entityManager->flush();
    }
}
