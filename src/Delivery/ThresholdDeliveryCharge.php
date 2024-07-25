<?php

namespace Acme\Delivery;

/**
 * A delivery charge rule with threshold pricing.
 */
class ThresholdDeliveryCharge implements DeliveryCharge {

    /**
     * Calculates the delivery charge based on the total amount.
     *
     * @param float $total The total amount before delivery charge.
     * @return float The delivery charge.
     */
    public function calculateDeliveryCharge(float $total): float {
        if ($total < 50) {
            return 4.95;
        } elseif ($total < 90) {
            return 2.95;
        }
        return 0.00;
    }
}
?>
