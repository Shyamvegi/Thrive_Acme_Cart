<?php

namespace Acme\Basket;

/**
 * Interface for the Basket class.
 */
interface BasketInterface {
    /**
     * Adds a product to the basket.
     *
     * @param string $productCode The code of the product to add.
     * @param int $quantity The quantity of the product to add (default is 1).
     *
     * @throws InvalidArgumentException If the product code is not found in the catalog.
     */
    public function add(string $productCode, int $quantity = 1): void;

    /**
     * Calculates the total cost of the basket, including delivery charges and discounts.
     *
     * @return float The total cost of the basket, rounded to 2 decimal places.
     */
    public function total(): float;
}
?>
