<?php

namespace Acme\Product;

/**
 * Represents a product with a code, name, and price.
 */
class Product {

    private string $code;
    private string $name;
    private float $price;

    /**
     * Constructs a new Product instance.
     *
     * @param string $code The product code.
     * @param string $name The product name.
     * @param float $price The product price.
     */
    public function __construct(string $code, string $name, float $price) {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * Gets the product code.
     *
     * @return string The product code.
     */
    public function getCode(): string {
        return $this->code;
    }


    /**
     * Gets the product name.
     *
     * @return string The product name.
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Gets the product price.
     *
     * @return float The product price.
     */
    public function getPrice(): float {
        return $this->price;
    }
}
?>
