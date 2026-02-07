<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, ArticleImage>
     */
    #[ORM\OneToMany(targetEntity: ArticleImage::class, mappedBy: 'article', cascade: ['persist'], orphanRemoval: true)]
    private Collection $articleImages;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $published_at = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Category $category = null;

    public function __construct()
    {
        $this->articleImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, ArticleImage>
     */
    public function getArticleImages(): Collection
    {
        return $this->articleImages;
    }

    public function addArticleImage(ArticleImage $articleImage): static
    {
        if (!$this->articleImages->contains($articleImage)) {
            $this->articleImages->add($articleImage);
            $articleImage->setArticle($this);
        }

        return $this;
    }

    public function removeArticleImage(ArticleImage $articleImage): static
    {
        if ($this->articleImages->removeElement($articleImage)) {
            // set the owning side to null (unless already changed)
            if ($articleImage->getArticle() === $this) {
                $articleImage->setArticle(null);
            }
        }

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->published_at;
    }

    public function setPublishedAt(\DateTimeImmutable $published_at): static
    {
        $this->published_at = $published_at;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
