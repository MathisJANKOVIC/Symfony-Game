<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Invoice;
use Faker\Factory;

class InvoiceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_Fr');

        for ($i = 0; $i < 10; $i++) {
            $invoice = new Invoice();
            $invoice->setName($faker->words(4, true));
            $invoice->setTotalHT(mt_rand(10, 100));
            $invoice->setTotalTVA($invoice->getTotalHT()*20/100);
            $invoice->setTotalTTC($invoice->getTotalHT()+$invoice->getTotalTVA());
            $manager->persist($invoice);
        }

        $manager->flush();
    }
}
