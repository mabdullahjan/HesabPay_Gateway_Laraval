Follow integration Steps at >> https://codericu.com/hesabpay-payment-integration-in-laraval-php/



1. Go To App//Http//Controllers/CheckoutController.php


   public function checkout(Request $request)
    {
        // Validate the request data
        $request->validate([
            'numItems' => 'required|integer|min:1',
        ]);
    
        $api_key = 'Your Api Key Here';
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
