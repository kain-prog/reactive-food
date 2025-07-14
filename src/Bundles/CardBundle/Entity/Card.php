<?php

namespace App\Bundles\CardBundle\Entity;

use App\Bundles\CardBundle\Repository\CardRepository;
use App\Bundles\CustomerBundle\Entity\Customer;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[Groups(['card'])]
#[ORM\HasLifecycleCallbacks()]
#[ORM\Entity(repositoryClass: CardRepository::class)]
#[ORM\Table(name: "card", indexes: [])]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $number;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $valid_thru;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $cvv;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'cards')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?Customer $customer = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getValidThru(): string
    {
        return $this->valid_thru;
    }

    public function setValidThru(string $valid_thru): void
    {
        $this->valid_thru = $valid_thru;
    }

    public function getCvv(): string
    {
        return $this->cvv;
    }

    public function setCvv(string $cvv): void
    {
        $this->cvv = $cvv;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
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
        return substr($this->number, -4);
    }
}
