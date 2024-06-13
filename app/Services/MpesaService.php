<?php

namespace App\Services;

use Safaricom\Mpesa\Mpesa;

class MpesaService
{
    protected $mpesa;

    public function __construct()
    {
        $this->mpesa = new Mpesa();
    }

    public function stkPushRequest($amount, $phoneNumber, $accountReference, $transactionDesc)
    {
        $response = $this->mpesa->STKPushSimulation(
            env('MPESA_SHORTCODE'),
            env('MPESA_PASSKEY'),
            'CustomerPayBillOnline',
            $amount,
            $phoneNumber,
            env('MPESA_SHORTCODE'),
            $phoneNumber,
            env('MPESA_SHORTCODE'),
            $accountReference,
            $transactionDesc,
            'https://mydomain.com/path'
        );

        return $response;
    }
}
