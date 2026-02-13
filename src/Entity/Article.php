<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[Vich\Uploadable]
#[ORM\HasLifecycleCallbacks]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:'Ce champ est obligatoire')]
    private ?string $title = null;

    /**
     * @var Collection<int, ArticleImage>
     */
    #[ORM\OneToMany(targetEntity: ArticleImage::class, mappedBy: 'article', cascade: ['persist'], orphanRemoval: true)]
    private Collection $articleImages;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $published_at = null;

    #[Vich\UploadableField(mapping: 'articleMainImage', fileNameProperty: 'main_image')]
    private ?File $main_image_file = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $main_image = null;

    #[ORM\PrePersist]
    public function setPublishedAtValue(): void
    {
        $this->published_at = new \DateTimeImmutable();
    }

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message:'Ce champ est obligatoire')]
    private ?Category $category = null;

    public function __construct()
    {
        $this->articleImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getMainImage(): ?string
    {
        return $this->main_image;
    }

    public function setMainImage(?string $main_image): static
    {
        $this->main_image = $main_image;

        return $this;
    }

    public function setMainImageFile(?File $main_image_file): static
    {
        $this->main_image_file = $main_image_file;

        return $this;
    }

    public function getMainImageFile(): ?File
    {
        return $this->main_image_file;
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
