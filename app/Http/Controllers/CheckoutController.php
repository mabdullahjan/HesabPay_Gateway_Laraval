<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
 

class CheckoutController extends Controller
{
    public function index()
    {
        // Retrieve the list of items available for selection
        $items = [
            ['id' => 1, 'name' => 'Item 1', 'price' => 10],
            ['id' => 2, 'name' => 'Item 2', 'price' => 20]
        ];

        // Pass the list of items to the view
        return view('checkout.index', compact('items'));
    }

    public function checkout(Request $request)
    {
        // Validate the request data
        $request->validate([
            'numItems' => 'required|integer|min:1',
        ]);
    
        //just past your api key here created in hesabpay sandbox
        $api_key = 'YOUR API KEY HERE';
        $numItems = $request->input('numItems');
        $items = [];
    
        // Collect selected items
        for ($i = 1; $i <= $numItems; $i++) {
            $items[] = ['name' => 'mobile a32', 'price' => '32'];
        }
    
        // Call the function to create payment session
        $response = $this->create_payment_session($api_key, $items);
    
        // Check if the response contains a new URL
        if (isset($response['url'])) {
            // Append total amount as a query parameter to the URL
            $totalAmount = array_reduce($items, function ($carry, $item) {
                return $carry + $item['price'];
            }, 0);
            $redirectUrl = $response['url'] . '?totalAmount=' . $totalAmount;
    
            // Redirect the user to the new URL
            return redirect()->away($redirectUrl);
        }
    
        // Display the response
        dd($response);
    }
    

    public function create_payment_session($api_key, $items)
    {
        $endpoint = "https://api-sandbox.hesab.com/api/v1/payment/create-session";
        $headers = ["Authorization: API-KEY " . $api_key];
        $payload = ["items" => $items];

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {
            return json_decode($response, true);
        } else {
            return ["error" => "HTTP Error: " . curl_getinfo($ch, CURLINFO_HTTP_CODE), "message" => $response];
        }
        curl_close($ch);
    }
}
