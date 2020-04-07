<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @UniqueEntity("name")
 */
class Category
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
     *      minMessage = "Your category name must be at least {{ limit }} characters long",
     *      maxMessage = "Your category name cannot be longer than {{ limit }} characters"
     * )
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="category")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\News", mappedBy="category")
     */
    private $news;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SpiritualPearls", mappedBy="category")
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

    public function setName(string $name): self
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

    /**
     * @return bool
     */
    public function hasArticle(){
        return !$this->articles->isEmpty();
    }

    /**
     * @param Article $article
     * @return $this
     */
    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setCategory($this);
        }

        return $this;
    }

    /**
     * @param Article $article
     * @return $this
     */
    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getCategory() === $this) {
                $article->setCategory(null);
            }
        }

        return $this;
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
            $news->setCategory($this);
        }

        return $this;
    }

    public function removeNews(News $news): self
    {
        if ($this->news->contains($news)) {
            $this->news->removeElement($news);
            // set the owning side to null (unless already changed)
            if ($news->getCategory() === $this) {
                $news->setCategory(null);
            }
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

    public function addSpiritualPearl(SpiritualPearls $spiritualPearl): self
    {
        if (!$this->spiritualPearls->contains($spiritualPearl)) {
            $this->spiritualPearls[] = $spiritualPearl;
            $spiritualPearl->setCategory($this);
        }

        return $this;
    }

    public function removeSpiritualPearl(SpiritualPearls $spiritualPearl): self
    {
        if ($this->spiritualPearls->contains($spiritualPearl)) {
            $this->spiritualPearls->removeElement($spiritualPearl);
            // set the owning side to null (unless already changed)
            if ($spiritualPearl->getCategory() === $this) {
                $spiritualPearl->setCategory(null);
            }
        }

        return $this;
    }
}
