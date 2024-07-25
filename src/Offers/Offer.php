<?php
namespace Acme\Offers;
/**
 * Interface for offer rules.
 */
interface Offer{

    /**
     * Applies the offers and returns the discount.
     *
     * @param Product[] $items The items in the basket.
     * @return float The discount amount.
     */

    public function apply(array $items): float;
}

?>