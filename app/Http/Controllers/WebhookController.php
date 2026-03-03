<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handleStripe(Request $request)
{
    $payload = $request->all();

    // Look for the 'checkout.session.completed' event
    if ($payload['type'] === 'checkout.session.completed') {
        $session = $payload['data']['object'];
        
        // Use the metadata or order reference you sent earlier
        // (Note: You might need to add 'metadata' => ['order_id' => $order->id] to your Session::create)
        $orderId = $session['metadata']['order_id'] ?? null;

        if ($orderId) {
            Order::where('id', $orderId)->update(['status' => 'confirmed']);
        }
    }

    return response()->json(['status' => 'success']);
}
}
