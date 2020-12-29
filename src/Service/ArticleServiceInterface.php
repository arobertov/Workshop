<?php


namespace App\Service;


use App\Entity\Article;

interface ArticleServiceInterface
{
    public function allArticles();

    public function createArticle(Article $article);

    public function editArticle(Article $article);

    public function deleteArticle(Article $article);
}