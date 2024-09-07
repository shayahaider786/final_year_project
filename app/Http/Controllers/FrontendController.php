<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerData;
use Stripe\Stripe;
use Stripe\Charge;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class FrontendController extends Controller
{
      public function index(){
        return view('frontend');
      }
      // Show the registration form
      public function registerUser()
      {
          return view('frontend.register');
      }
  
      public function store(Request $request)
      {
          // Validate form data
          $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email|max:255',
              'phone' => 'required|string|regex:/^[0-9]{10,15}$/',
              'plan' => 'required|in:startup,standard,business',
              'payment_method' => 'required|in:paypal,stripe',
          ]);
      
          // Set the price based on the plan
          $planPrices = [
              'startup' => 40,
              'standard' => 90,
              'business' => 150,
          ];
          $planPrice = $planPrices[$request->plan];
      
          // Store customer data
          $customer = CustomerData::create([
              'name' => $request->name,
              'email' => $request->email,
              'phone' => $request->phone,
              'plan' => $request->plan,
              'payment_status' => 'pending', // Set initial payment status
          ]);
      
          // Handle Payment
          if ($request->payment_method == 'stripe') {
              return $this->handleStripePayment($request, $planPrice, $customer);
          } elseif ($request->payment_method == 'paypal') {
              return $this->handlePaypalPayment($planPrice, $customer);
          }
      }
      
      // Handle Stripe Payment
      protected function handleStripePayment(Request $request, $amount, $customer)
      {
          \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      
          try {
              // Create a charge
              $charge = \Stripe\Charge::create([
                  'amount' => $amount * 100, // Stripe expects amount in cents
                  'currency' => 'usd',
                  'description' => 'Payment for ' . $request->plan . ' plan',
                  'source' => $request->stripeToken,
              ]);
      
              // Update payment status
              $customer->update(['payment_status' => 'completed']);
      
              return redirect()->route('index')->with('success', 'Payment successful and plan selected.');
          } catch (\Exception $e) {
              return redirect()->route('index')->with('error', $e->getMessage());
          }
      }
      
      // Handle PayPal Payment
      protected function handlePaypalPayment($amount, $customer)
      {
          $paypal = new PayPalClient();
          $paypal->setApiCredentials(config('paypal'));
          $paypalToken = $paypal->getAccessToken();
          $paypal->setAccessToken($paypalToken);
      
          $response = $paypal->createOrder([
              "intent" => "CAPTURE",
              "purchase_units" => [
                  0 => [
                      "amount" => [
                          "currency_code" => "USD",
                          "value" => $amount
                      ]
                  ]
              ],
              "application_context" => [
                  "return_url" => route('payment.success', $customer->id),
                  "cancel_url" => route('payment.cancel'),
              ]
          ]);
      
          if (isset($response['id'])) {
              foreach ($response['links'] as $link) {
                  if ($link['rel'] === 'approve') {
                      return redirect()->away($link['href']);
                  }
              }
          }
      
          return redirect()->route('index')->with('error', 'PayPal payment failed.');
      }
      
      // Handle PayPal success
      public function paymentSuccess(Request $request, $customerId)
      {
          $customer = CustomerData::find($customerId);
          // Update payment status
          $customer->update(['payment_status' => 'completed']);
          
          return redirect()->route('index')->with('success', 'Payment successful for ' . $customer->plan . ' plan.');
      }
}