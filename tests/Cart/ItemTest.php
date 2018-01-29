<?php

declare(strict_types = 1);

namespace Gwo\Recruitment\Tests\Cart;

use Gwo\Recruitment\Cart\Item;
use Gwo\Recruitment\Entity\Product;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    /**
     * @test
     */
    public function itAcceptsConstructorArgumentsAndReturnsData()
    {
        $product = new Product();
        $item = new Item($product, 10);

        $this->assertEquals($product, $item->getProduct());
        $this->assertEquals(10, $item->getQuantity());
    }
}
