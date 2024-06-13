<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Method to show the payment form view
    public function showPaymentForm()
    {
        return view('payment');
    }

    // Method to initiate the payment process
    public function initiatePayment(Request $request)
    {
        // Get form input
        $amount = $request->input('amount');
        $phoneNumber = $request->input('phone_number');

        // Assuming you are integrating with a payment gateway like M-Pesa
        // Here you would initiate the payment with the gateway
        // Below is a dummy example

        // Payment initiation logic
        $paymentResult = $this->makePayment($amount, $phoneNumber);

        // Assuming the payment gateway returns success
        if ($paymentResult === true) {
            return redirect()->back()->with('success', 'Payment initiated successfully!');
        } else {
            return redirect()->back()->with('error', 'Payment initiation failed. Please try again.');
        }
    }

    // Dummy method to simulate payment
    private function makePayment($amount, $phoneNumber)
    {
        // Here you would integrate with your payment gateway
        // Dummy logic, return true for success, false for failure
        return true;
    }

    // Method to handle M-Pesa callback
    public function handleCallback(Request $request)
    {
        // Validate the callback request, check if it's from your payment gateway

        // Assuming the callback URL is https://mydomain.com/pat
        if ($request->url() === 'https://mydomain.com/pat') {
            // Handle the callback logic here
            // This is where you would update your database, log the transaction, etc.

            // For example, you can log the callback data
            \Log::info('Callback Data: ', $request->all());

            // Send a response to the payment gateway indicating successful receipt of the callback
            return response()->json(['status' => 'success']);
        } else {
            // If callback URL doesn't match, respond with error
            return response()->json(['status' => 'error', 'message' => 'Invalid callback URL']);
        }
    }
}
