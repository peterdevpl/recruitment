<?php

declare(strict_types = 1);

namespace Gwo\Recruitment\Tests\Cart;

use Gwo\Recruitment\Cart\Cart;
use Gwo\Recruitment\Entity\Product;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    /**
     * @test
     */
    public function itAddsOneProduct()
    {
        $product = $this->buildTestProduct1();

        $cart = new Cart();
        $cart->addItem($product, 1);

        $this->assertCount(1, $cart->getItems());
        $this->assertEquals(15000, $cart->getTotalPrice());
        $this->assertEquals($product, $cart->getItem(0)->getProduct());
    }

    /**
     * @test
     */
    public function itRemovesExistingProduct()
    {
        $product1 = $this->buildTestProduct1();
        $product2 = $this->buildTestProduct2();

        $cart = new Cart();
        $cart
            ->addItem($product1, 1)
            ->addItem($product2, 1);

        $cart->removeItem($product1);

        $this->assertCount(1, $cart->getItems());
        $this->assertEquals(10000, $cart->getTotalPrice());
        $this->assertEquals($product2, $cart->getItem(0)->getProduct());
    }

    /**
     * @test
     */
    public function itIncreasesQuantityOfAnExistingItem()
    {
        $product = $this->buildTestProduct1();

        $cart = new Cart();
        $cart
            ->addItem($product, 1)
            ->addItem($product, 2);

        $this->assertCount(1, $cart->getItems());
        $this->assertEquals(45000, $cart->getTotalPrice());
    }

    /**
     * @test
     */
    public function itUpdatesQuantityOfAnItem()
    {
        $product = $this->buildTestProduct1();

        $cart = new Cart();
        $cart
            ->addItem($product, 1)
            ->setQuantity($product, 2);

        $this->assertEquals(30000, $cart->getTotalPrice());
        $this->assertEquals(2, $cart->getItem(0)->getQuantity());
    }

    /**
     * @test
     * @expectedException \Gwo\Recruitment\Cart\Exception\QuantityTooLowException
     */
    public function itThrowsExceptionWhenQuantityIsTooLow()
    {
        $product = $this->buildTestProduct1();
        $product->setMinimumQuantity(10);

        $cart = new Cart();
        $cart->addItem($product, 9);
    }

    private function buildTestProduct1()
    {
        $product = new Product();
        $product
            ->setId(1)
            ->setUnitPrice(15000);

        return $product;
    }

    private function buildTestProduct2()
    {
        $product = new Product();
        $product
            ->setId(2)
            ->setUnitPrice(10000);

        return $product;
    }
}
