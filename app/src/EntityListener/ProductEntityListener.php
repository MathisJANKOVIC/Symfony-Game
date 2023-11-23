<?php

namespace App\EntityListener;

use App\Entity\Product;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, entity: Product::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Product::class)]
class ProductEntityListener
{
    public function __construct(
        private SluggerInterface $slugger,
    ) {
    }

    public function prePersist(Product $product, LifecycleEventArgs $event)
    {
        $product->computeSlug($this->slugger);
    }

    public function preUpdate(Product $product, LifecycleEventArgs $event)
    {
        $product->computeSlug($this->slugger);
    }
}