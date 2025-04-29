<?php

namespace App\Services;

use App\Models\EasyPay;
use App\Models\Customer;
use MarvinLabs\Luhn\Facades\Luhn;

class EasyPayService
{

    /**
     * Generate an EasyPay number.
     *
     * @param  Customer $customer
     * @return EasyPay
     */
    public function save(Customer $customer) : EasyPay
    {
        // Get Configs
        $recieverId = config('easypay.recieverId');
        $character_limit = config('easypay.total_character_length'); ## CORRECT TO TOTAL!!!!!

        // 1 - Generate EasyPay Number
        $easyPayNumber = $this->generate($customer->splynx_id);

        // 2 - Create EasyPay Record
        return EasyPay::create([
            'customerId' => $customer->splynx_id,
            'splynx_id' => $customer->splynx_id,
            'easypay_number' => $easyPayNumber,
            'reciever_id' => $recieverId,
            'charachter_length' => $character_limit,
            'check_digit' => substr($easyPayNumber, -1),
        ]);
    }

    /**
     * Generate an EasyPay number.
     *
     * @param  string  $customerId
     * @return string
     */
    // public function generate(string $customerId) : string
    // {
    //     // Get Configs
    //     $recieverId = config('easypay.recieverId');
    //     $character_limit = config('easypay.character_limit');

    //     // Prepend (To Left) extra zeros to the customer ID
    //     // $paddedCustomerId = str_pad($customerId, $character_limit, '0', STR_PAD_RIGHT);
    //     $paddedCustomerId = str_pad($customerId, $character_limit, '0', STR_PAD_LEFT);

        
    //     // Calculate the Luhn checksum digit
    //     $baseNumber = $recieverId . $paddedCustomerId;
    //     // $checkDigit = $this->calculateLuhnCheckDigit($baseNumber);
    //     $checkDigit = Luhn::computeCheckDigit($baseNumber);
    //     dd('Base: ' . $baseNumber . 'Checkdigit: ' . $checkDigit);
        
    //     // Create the EasyPay number
    //     return '9' . $baseNumber . $checkDigit;
    //     // return '9' . $recieverId . $paddedCustomerId . $checkDigit;
    //     //      Const, RecieverId,  CustomerId + Padding (0),  CheckDigit
    // }

    public function generate(string $customerId): string
    {
        // Get Configs
        $recieverId = config('easypay.recieverId');
        $total_length = config('easypay.total_character_length'); // Now setting total length instead of padding manually

        // Calculate how much padding is needed
        $base_length = strlen($recieverId) + strlen($customerId); // Base number without padding
        $padding_needed = $total_length - ($base_length + 2); // Subtract 2 for the leading '9' and check digit

        if ($padding_needed < 0) {
            throw new \Exception("Total character length is too short to accommodate the Customer ID.");
        }

        // Apply padding dynamically (left-padding for proper alignment)
        $paddedCustomerId = str_pad($customerId, strlen($customerId) + $padding_needed, '0', STR_PAD_LEFT);

        // Generate base number for Luhn calculation (without leading '9')
        $baseNumber = $recieverId . $paddedCustomerId;

        // Calculate the Luhn check digit using the package
        $checkDigit = Luhn::computeCheckDigit($baseNumber);

        // Construct the final EasyPay Number
        return '9' . $baseNumber . $checkDigit;
    }


    /**
     * Calculate the Luhn checksum digit.
     *
     * @param  string  $number
     * @return int
     */
    private function calculateLuhnCheckDigit(string $number): int
    {
        $sum = 0;
        $reverseDigits = strrev($number);

        for ($i = 0; $i < strlen($reverseDigits); $i++) {
            $digit = (int) $reverseDigits[$i];

            if ($i % 2 === 1) { // Double every second digit
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
        }

        return (10 - ($sum % 10)) % 10;
    }

}
