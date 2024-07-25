<?php

namespace Acme\Product;

/**
 * Manages the product catalog using a hashmap (associative array) for efficient lookups.
 */
class Catalog {

    private array $products = [];

    //optimisation
    private array $cache = [];

    /**
     * Catalog constructor.
     *
     * @param Product[] $products Array of Product objects to initialize the catalog.
     */
    public function __construct(array $products) {
        foreach ($products as $product) {
            $this->addProduct($product);
        }
        $this->cache = [];
    }


    /**
     * Catalog constructor.
     *
     * @param Product  Product objects to be added into the catalog.
     */
    public function addProduct(Product $product): void {
        if($this->getProduct($product->getCode()) === null){
            $this->products[$product->getCode()] = $product;
        }

    }


    /**
     * Finds a product by its code.
     *
     * @param string $code The product code.
     * @return Product|null The Product object if found, null otherwise.
     */
    public function getProduct(string $code): ?Product {
        // Check cache first
        if (isset($this->cache[$code])) {
            return $this->cache[$code];
        }

        // If not in cache, fetch from productsByCode
        $product = $this->products[$code] ?? null;

        $this->cache[$code] = $product;  // Cache the result
        return $product;
    }
}
?>
