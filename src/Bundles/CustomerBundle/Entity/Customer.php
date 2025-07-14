<?php

namespace App\Bundles\CustomerBundle\Entity;

use App\Bundles\AddressBundle\Entity\Address;
use App\Bundles\CardBundle\Entity\Card;
use App\Bundles\CustomerBundle\Repository\CustomerRepository;
use App\Bundles\OrderBundle\Entity\Order;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[Groups(['customer'])]
#[ORM\HasLifecycleCallbacks()]
#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ORM\Table(name: "customer", indexes: [])]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $email;

    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'customer')]
    private ?Collection $orders;

    #[ORM\OneToMany(targetEntity: Address::class, mappedBy: 'customer')]
    private ?Collection $addresses;

    #[ORM\OneToMany(targetEntity: Card::class, mappedBy: 'customer')]
    private ?Collection $cards;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $updated_at = null;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->cards = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAddresses(): ?Collection
    {
        return $this->addresses;
    }

    public function getCards(): ?Collection
    {
        return $this->cards;
    }

    public function getOrders(): ?Collection
    {
        return $this->orders;
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
