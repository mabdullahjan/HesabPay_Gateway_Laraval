<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Verify the webhook request, if required
        // This might involve checking a signature or token sent by the API

        // Log the incoming webhook request
        Log::info('Webhook received:', $request->all());

        // Process the webhook payload
        // You can perform any necessary processing here

        // Respond to the webhook with a success message
        return response()->json(['message' => 'Webhook received'], 200);
    }
}
