<?php

namespace Acme\Offers;

use Acme\Product\Catalog;


/**
 * An offer rule for buying one red widget and getting the second half price.
 */
class Buy1GetSecondHalfOffer implements Offer {

    private Catalog $catalog;
    private String $offeredProductCode;

    public function __construct(Catalog $catalog, String $offeredProductCode){
        $this->catalog = $catalog;
        $this->offeredProductCode = $offeredProductCode;
    }

    /**
     * Applies the red widget offer and returns the discount.
     *
     * @param Product[] $items The items in the basket.
     * @return float The discount amount.
     */
    public function apply(array $items): float {
        $discount = 0.00;
        $quantiy = ($items[$this->offeredProductCode]) ?? 0;
        $product = $this->catalog->getProduct($this->offeredProductCode);
        if ($product && $quantiy > 0) {
            $discount = (int)($quantiy / 2) * ($product->getPrice() / 2); // Buy one get second half price
        }
        return $discount;
    }
}
?>
