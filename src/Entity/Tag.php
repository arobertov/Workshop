<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 * @UniqueEntity("name")
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your tag must be at least {{ limit }} characters long",
     *      maxMessage = "Your tag cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Article", mappedBy="tags")
     */
    private $articles;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\News", mappedBy="tags")
     */
    private $news;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SpiritualPearls", mappedBy="tags")
     */
    private $spiritualPearls;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->news = new ArrayCollection();
        $this->spiritualPearls = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addTags(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->addTag($this);
        }

        return $this;
    }

    public function removeTags(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            $article->removeTag($this);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function hasArticle(){
        return !$this->getArticles()->isEmpty();
    }

    /**
     * @return Collection|News[]
     */
    public function getNews(): Collection
    {
        return $this->news;
    }

    public function addNews(News $news): self
    {
        if (!$this->news->contains($news)) {
            $this->news[] = $news;
            $news->addTag($this);
        }

        return $this;
    }

    public function removeNews(News $news): self
    {
        if ($this->news->contains($news)) {
            $this->news->removeElement($news);
            $news->removeTag($this);
        }

        return $this;
    }

    /**
     * @return Collection|SpiritualPearls[]
     */
    public function getSpiritualPearls(): Collection
    {
        return $this->spiritualPearls;
    }

    public function addSpiritualPearls(SpiritualPearls $category): self
    {
        if (!$this->spiritualPearls->contains($category)) {
            $this->spiritualPearls[] = $category;
            $category->addTag($this);
        }

        return $this;
    }

    public function removeSpiritualPearls(SpiritualPearls $spiritualPearls): self
    {
        if ($this->spiritualPearls->contains($spiritualPearls)) {
            $this->spiritualPearls->removeElement($spiritualPearls);
            $spiritualPearls->removeTag($this);
        }

        return $this;
    }
}
