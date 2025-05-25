<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\Laptop;
use App\Models\Accessory;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Handle both direct product purchases and cart checkouts
    public function show(Request $request, $product_id = null, $type = null)
{
    if ($request->has('items')) {
        $request->validate([
            'total_amount' => 'required|numeric',
            'items' => 'required|array'
        ]);

        $items = $request->items;

        // Hitung subtotal dari items
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item['price'] * ($item['quantity'] ?? 1);
        }

        // Hitung shipping dengan fungsi yang sudah ada
        $shipping = $this->calculateShipping($items);

        $firstItem = $items[array_key_first($items)];

        return view('payment.payment', [
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping,
            'product' => (object)[
                'id' => $firstItem['id'],
                'name' => $firstItem['name'],
                'price' => $firstItem['price'],
                'picture' => $firstItem['picture'] ?? null,
                'brand' => $firstItem['brand'] ?? null
            ],
            'productType' => $firstItem['type'],
            'items' => $items
        ]);
    }

    if ($product_id && $type) {
        $product = $this->getProduct($product_id, $type);

        // Kalau beli satu produk langsung
        $subtotal = $product->price;
        $shipping = $this->calculateShipping([[
            'weight' => $product->weight ?? 1
        ]]);
        $total = $subtotal + $shipping;

        return view('payment.payment', [
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
            'product' => $product,
            'productType' => $type,
            'items' => null
        ]);
    }

    return redirect()->back()->with('error', 'Please select a product first');
}


    public function process(Request $request)
    {
        $validated = $this->validatePaymentRequest($request);

        // Process payment logic
        $paymentResult = $this->processPayment($validated);

        if ($paymentResult['success']) {
            $this->clearCart();
            return redirect()->route('payment.success')
                ->with('success', 'Payment processed successfully!')
                ->with('transaction_id', $paymentResult['transaction_id']);
        }

        return back()->with('error', 'Payment failed: '.$paymentResult['message']);
    }

    public function success()
    {
        if (!session()->has('success')) {
            return redirect()->route('dashboard');
        }

        return view('payment.success', [
            'transaction_id' => session('transaction_id')
        ]);
    }

    // Helper methods
    protected function getProduct($id, $type)
    {
        return match($type) {
            'phone' => Phone::findOrFail($id),
            'laptop' => Laptop::findOrFail($id),
            'accessory' => Accessory::findOrFail($id),
            default => abort(404, 'Product type not found')
        };
    }

    protected function validatePaymentRequest(Request $request)
    {
        return $request->validate([
            'product_id' => 'required|integer',
            'product_type' => 'required|string|in:phone,laptop,accessory',
            'name' => 'required|string|max:255',
            'card_number' => 'required|string|size:16',
            'expiry' => 'required|date|after_or_equal:today',
            'cvv' => 'required|string|min:3|max:4',
            'amount' => 'required|numeric|min:0',
            'items' => 'sometimes|array'
        ]);
    }

    // Mengambil cart dari session dan hitung subtotal
protected function getCartItems()
{
    $items = session('cart.items', []);
    $cartItems = [];
    $subtotal = 0;

    foreach ($items as $item) {
        $product = $this->getProduct($item['id'], $item['type']);
        $cartItems[] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $item['quantity'],
            'type' => $item['type'],
            'picture' => $product->picture ?? null
        ];
        $subtotal += $product->price * $item['quantity'];
    }
    return [$cartItems, $subtotal];
}

// Removed duplicate checkout() method to resolve duplicate symbol error


    protected function processPayment($data)
    {
        // Implement actual payment processing here
        // This is just a mock implementation
        
        try {
            // Simulate payment processing
            return [
                'success' => true,
                'transaction_id' => 'TX'.time().rand(1000,9999),
                'message' => 'Payment successful'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    // Di Controller Anda
// Di Controller (CheckoutController.php atau sejenisnya)
public function showCheckout()
{
    $cartItems = [];
    $subtotal = 0;

    // Ambil dari session atau database
    foreach (session('cart.items', []) as $item) {
        $product = $this->getProduct($item['id'], $item['type']);
        
        $cartItems[] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price, // Harga aktual dari database
            'quantity' => $item['quantity'],
            'type' => $item['type'],
            'picture' => $product->picture
        ];

        $subtotal += $product->price * $item['quantity'];
    }

    $shipping = $this->calculateShipping($cartItems);
    $total = $subtotal + $shipping;

    return view('checkout', compact('cartItems', 'subtotal', 'shipping', 'total'));
}
// In your controller (e.g., PaymentController.php)
// Di Controller (PaymentController.php atau sejenisnya)
public function checkout()
{
    // Ambil data cart dari session
    $cartItems = session('cart.items', []);
    
    // Hitung subtotal
    $subtotal = array_reduce($cartItems, function($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);
    
    // Hitung shipping (contoh: 10% dari subtotal dengan minimum 10.000)
    $shipping = max(10000, $subtotal * 0.1);
    
    // Hitung total
    $total = $subtotal + $shipping;
    
    return view('payment.checkout', [
        'items' => $cartItems,
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'total' => $total,
        'cartCount' => count($cartItems)
    ]);
}
/**
 * Menghitung biaya pengiriman
 */
protected function calculateShipping(array $items)
{
    $baseShipping = 10000;
    $additionalFee = 0;
    
    // Contoh logika pengiriman:
    foreach ($items as $item) {
        $weight = $item['weight'] ?? 1;
        $additionalFee += $weight * 2000; // Rp 2.000 per kg
    }
    
    return $baseShipping + $additionalFee;
}

    protected function clearCart()
    {
        if (session()->has('cart')) {
            session()->forget('cart');
        }
    }
}