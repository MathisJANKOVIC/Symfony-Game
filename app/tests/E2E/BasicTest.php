<?php

namespace App\Tests\E2E;

use Symfony\Component\Panther\PantherTestCase;

class BasicTest extends PantherTestCase
{
    public function testEnvrionnementIsOk(): void
    {
        $client = self::createPantherClient([
            'browser' => PantherTestCase::CHROME
        ]);

        $client->request('GET', '/');
        $this->assertSelectorExists('h1');
    }
}