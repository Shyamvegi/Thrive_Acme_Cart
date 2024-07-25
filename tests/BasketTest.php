<?php

use PHPUnit\Framework\TestCase;
use Acme\Product\Product;
use Acme\Basket\Basket;
use Acme\Product\Catalog;
use Acme\Delivery\ThresholdDeliveryCharge;
use Acme\Offers\Buy1GetSecondHalfOffer;


/**
 * Class BasketTest
 *
 * Unit tests for the Basket class.
 */
class BasketTest extends TestCase {
    private Catalog $catalog;
    private $deliveryRules;
    private $offerRules;

    protected function setUp(): void {
        $this->catalog = new Catalog([
            new Product('R01', 'Red Widget', 32.95),
            new Product('G01', 'Green Widget', 24.95),
            new Product('B01', 'Blue Widget', 7.95),
        ]);
        $this->deliveryRules = new ThresholdDeliveryCharge();
        $this->offerRules = [new Buy1GetSecondHalfOffer($this->catalog,"R01")];
    }

    public function testAddProduct(): void {
        $basket = new Basket($this->catalog, $this->deliveryRules, $this->offerRules);
        $basket->add('B01');  // Add a Blue Widget
        $this->assertEquals(12.9, $basket->total());  // $7.95 + $4.95 delivery charge
    }

    public function testAddInvalidProduct(): void {
        $basket = new Basket($this->catalog, $this->deliveryRules, $this->offerRules);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Product code 'INVALID' not found.");
        $basket->add('INVALID');
    }

    public function testBasketTotal(): void {
        $basket = new Basket($this->catalog, $this->deliveryRules, $this->offerRules);
        $basket->add('B01');  // Add a Blue Widget
        $basket->add('G01');  // Add a Green Widget
        $this->assertEquals(37.85, $basket->total());  // $7.95 + $24.95 + $4.95 delivery charge
    }

    public function testBasketTotalWithOffer(): void {
        $basket = new Basket($this->catalog, $this->deliveryRules, $this->offerRules);
        $basket->add('R01');  // Add first Red Widget
        $basket->add('R01');  // Add second Red Widget
        $this->assertEquals(54.37, $basket->total());  // $32.95 + $16.475 + $4.95 delivery charge
    }

    public function testBasketTotalWithMixedProducts(): void {
        $basket = new Basket($this->catalog, $this->deliveryRules, $this->offerRules);
        $basket->add('R01');  // Add a Red Widget
        $basket->add('G01');  // Add a Green Widget
        $this->assertEquals(60.85, $basket->total());  // $32.95 + $24.95 + $2.95 delivery charge
    }

    public function testBasketTotalWithMultipleProducts(): void {
        $basket = new Basket($this->catalog, $this->deliveryRules, $this->offerRules);
        $basket->add('B01');  // Add first Blue Widget
        $basket->add('B01');  // Add second Blue Widget
        $basket->add('R01');  // Add first Red Widget
        $basket->add('R01');  // Add second Red Widget
        $basket->add('R01');  // Add third Red Widget
        $this->assertEquals(98.27, $basket->total());  // $7.95 * 2 + $32.95 * 3 + $2.95 delivery charge
    }
}
?>
