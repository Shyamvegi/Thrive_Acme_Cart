<?php

namespace Acme\Basket;

use Acme\Product\Catalog;
use Acme\Delivery\DeliveryCharge;
use Acme\Offer\Offer;
use InvalidArgumentException;

/**
 * Represents a basket to buy widgets.
 */
class Basket implements BasketInterface {

    private Catalog $catalog;
    private $deliveryChargeRules;
    private array $offerRules;
    private array $items = [];

    /**
     * Constructs a new Basket instance.
     *
     * @param Catalog $catalog The product catalog.
     * @param  $deliveryChargeRules The rule for calculating delivery charges.
     * @param  $offerRules The rule for applying offers.
     */
    public function __construct(Catalog $catalog, $deliveryChargeRules, $offerRules) {
        $this->catalog = $catalog;
        $this->deliveryChargeRules = $deliveryChargeRules;
        $this->offerRules = $offerRules;
    }

    /**
     * Adds a product to the basket.
     *
     * @param string $productCode The code of the product to add.
     * @param int $quantity The quantity of the product to add (default is 1).
     *
     * @throws InvalidArgumentException If the product code is not found in the catalog.
     */
    public function add(string $productCode, int $quantity = 1): void {
        $product = $this->catalog->getProduct($productCode);

        if (!$product) {
            throw new InvalidArgumentException("Product code '{$productCode}' not found.");
        }

        $this->items[$productCode] = ($this->items[$productCode] ?? 0) + $quantity;
    }

    /**
     * Calculates the total cost of the basket, including delivery charges and discounts.
     *
     * @return float The total cost of the basket, rounded to 2 decimal places.
     */
    public function total(): float {
        $subtotal =  array_reduce(array_keys($this->items), function(float $carry, string $productCode) {
            $product =  $this->catalog->getProduct($productCode);
            if ($product === null) {
                throw new \RuntimeException("Product with code $productCode not found in the catalog.");
            }
            return $carry + $product->getPrice() * $this->items[$productCode];
        }, 0.0);

        $discount = 0.0;
        // assumption is all offers can be applied
        foreach ($this->offerRules as $offer) {
            $discount += $offer->apply($this->items);
        }

        $totalAfterDiscount = $subtotal - $discount;
        $deliveryCharge = $this->deliveryChargeRules->calculateDeliveryCharge($totalAfterDiscount);
        return round($totalAfterDiscount+$deliveryCharge, 2, PHP_ROUND_HALF_DOWN);
    }

}
?>
