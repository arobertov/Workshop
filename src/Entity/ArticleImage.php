<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleImageRepository")
 */
class ArticleImage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageName;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\News", mappedBy="images")
     */
    private $news;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SpiritualPearls", mappedBy="images")
     */
    private $spiritualPearls;

    public function __construct()
    {
        $this->news = new ArrayCollection();
        $this->spiritualPearls = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): self
    {
        $this->imageName = $imageName;

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
            $news->addImage($this);
        }

        return $this;
    }

    public function removeNews(News $news): self
    {
        if ($this->news->contains($news)) {
            $this->news->removeElement($news);
            $news->removeImage($this);
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
            $spiritualPearl->addImage($this);
        }

        return $this;
    }

    public function removeSpiritualPearl(SpiritualPearls $spiritualPearl): self
    {
        if ($this->spiritualPearls->contains($spiritualPearl)) {
            $this->spiritualPearls->removeElement($spiritualPearl);
            $spiritualPearl->removeImage($this);
        }

        return $this;
    }
}
