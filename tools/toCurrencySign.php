<?php
function toCurrencySign($amount) {
    // Convert the amount to a float and format it with commas and two decimal places
    $formattedAmount = number_format((float)$amount, 2, '.', ',');
    // Add the peso sign at the beginning
    return '₱' . $formattedAmount;
}

