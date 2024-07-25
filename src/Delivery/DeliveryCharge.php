<?php

namespace Acme\Delivery;

/**
 * Interface for delivery charge rules.
 */
interface DeliveryCharge {
    /**
     * Calculates the delivery charge based on the total amount.
     *
     * @param float $total The total amount before delivery charge.
     * @return float The delivery charge.
     */
    public function calculateDeliveryCharge(float $total): float;
}
?>
