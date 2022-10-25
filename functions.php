<?php
function priceCalc($price,$quantity){
    $discounts = array(0, 0, .05, .1, .2, .25);

    if ($quantity > 5) {
        $quantityIndex = 5;
    } else {
        $quantityIndex = $quantity;
    }
    $discountPrice = $price - ($price * $discounts[$quantityIndex]);
    $total = $discountPrice * $quantity; 
    
    return round($total, 2);
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>