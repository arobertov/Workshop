<?php


namespace App\Service;


use App\Entity\Article;
use App\Repository\ArticleRepository;

class ArticleService implements ArticleServiceInterface
{

    protected $articleRepository ;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function allArticles()
    {
       return $this->articleRepository->findAllArticles();
    }

    public function createArticle(Article $article)
    {
        // TODO: Implement createArticle() method.
    }

    public function editArticle(Article $article)
    {
        // TODO: Implement editArticle() method.
    }

    public function deleteArticle(Article $article)
    {
        // TODO: Implement deleteArticle() method.
    }
}