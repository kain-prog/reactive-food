<?php

namespace App\Bundles\ProductBundle\Entity;

use App\Bundles\CategoryBundle\Entity\Category;
use App\Bundles\CustomerBundle\Entity\Customer;
use App\Bundles\ProductBundle\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[Groups(['product'])]
#[ORM\HasLifecycleCallbacks()]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: "product", indexes: [])]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $shortDescription;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $price;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $is_release = false;

    #[ORM\OneToMany(targetEntity: Category::class, mappedBy: 'product')]
    private ?Collection $category;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $updated_at = null;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getIsRelease(): bool
    {
        return $this->is_release;
    }

    public function setIsRelease(bool $is_release): void
    {
        $this->is_release = $is_release;
    }

    public function getCategory(): ArrayCollection
    {
        return $this->category;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $this->created_at = new \DateTime("now");
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updated_at = new \DateTime("now");
    }

    public function __toString(): string
    {
        return $this->name;
    }

}
