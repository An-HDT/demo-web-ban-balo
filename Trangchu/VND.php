<?php
    // session_start();
    function numberToVND($number) {
        $vndSymbol = "₫"; // VND symbol
        
        // Convert the number to VND format with commas
        $vndAmount = number_format($number, 0, ".", ",");
        
        // Concatenate the VND symbol with the formatted amount
        $vndAmount =  $vndAmount .$vndSymbol ;
        
        return $vndAmount;
    }
?>