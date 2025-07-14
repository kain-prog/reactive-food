<?php

namespace  App\Bundles\OrderBundle\Entity;

use App\Bundles\AddressBundle\Entity\Address;
use App\Bundles\CustomerBundle\Entity\Customer;
use App\Bundles\OrderBundle\Repository\OrderRepository;
use App\Bundles\ProductBundle\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[Groups(['order'])]
#[ORM\HasLifecycleCallbacks()]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: "order", indexes: [])]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $code;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $total_price;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $observations;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $payment_type;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $payment_method;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $payment_status;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $payment_return;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\ManyToOne(targetEntity: Address::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $address = null;

    #[ORM\ManyToMany(targetEntity: Product::class)]
    #[ORM\JoinTable(
        name: 'order_product',
        joinColumns: [new ORM\JoinColumn(name: 'order_id', referencedColumnName: 'id')],
        inverseJoinColumns: [new ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    )]
    private Collection $products;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $created_at;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $updated_at = null;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getTotalPrice(): string
    {
        return $this->total_price;
    }

    public function setTotalPrice(string $total_price): void
    {
        $this->total_price = $total_price;
    }

    public function getObservations(): ?string
    {
        return $this->observations;
    }

    public function setObservations(?string $observations): void
    {
        $this->observations = $observations;
    }

    public function getPaymentType(): string
    {
        return $this->payment_type;
    }

    public function setPaymentType(string $payment_type): void
    {
        $this->payment_type = $payment_type;
    }

    public function getPaymentMethod(): string
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(string $payment_method): void
    {
        $this->payment_method = $payment_method;
    }

    public function getPaymentStatus(): string
    {
        return $this->payment_status;
    }

    public function setPaymentStatus(string $payment_status): void
    {
        $this->payment_status = $payment_status;
    }

    public function getPaymentReturn(): ?string
    {
        return $this->payment_return;
    }

    public function setPaymentReturn(?string $payment_return): void
    {
        $this->payment_return = $payment_return;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function getProducts(): Collection
    {
        return $this->products;
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
        return $this->code;
    }
}
