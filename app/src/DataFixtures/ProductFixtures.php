<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_Fr');

        // create 20 products! Bam!
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setName($faker->words(4, true));
            $product->setPrice(mt_rand(10, 100));
            $product->setDescription($faker->realText(1800));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
