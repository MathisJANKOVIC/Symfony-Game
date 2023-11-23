<?php

namespace App\Entity;

use App\Repository\InvoiceLineRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\BaseTrait;

#[ORM\Entity(repositoryClass: InvoiceLineRepository::class)]
#[ORM\HasLifecycleCallbacks]
class InvoiceLine
{
    use BaseTrait;

    #[ORM\ManyToOne(inversedBy: 'invoiceLines')]
    private ?Invoice $invoice = null;

    #[ORM\ManyToOne(inversedBy: 'invoiceLines')]
    private ?Product $product = null;

    #[ORM\Column]
    private ?float $quantity = null;

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): static
    {
        $this->invoice = $invoice;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}
