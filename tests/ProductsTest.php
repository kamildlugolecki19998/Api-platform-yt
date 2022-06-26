<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class ProductsTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    public function testGetCollection(): void
    {
        static::createClient()->request('GET', '/api/products');

        $this->assertResponseIsSuccessful();

        $this->assertResponseHeaderSame(
            'content-type', 'application/ld+json; charset=utf-8',
        );

        $this->assertJsonContains([
            '@context' => '/api/contexts/Product',
            '@id' => '/api/products?page=1',
            '@type' => 'hydra:PartialCollectionView',
            '@id' => '/api/products',
            '@type' => 'hydra:Collection',
        ]);
    }

}
