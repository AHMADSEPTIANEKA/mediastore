<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\Laptop;
use App\Models\Accessory;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $type = $request->input('type');
        $id = $request->input('id');

        $product = null;

        if ($type === 'phone') {
            $product = Phone::findOrFail($id);
        } elseif ($type === 'laptop') {
            $product = Laptop::findOrFail($id);
        } elseif ($type === 'accessory') {
            $product = Accessory::findOrFail($id);
        } else {
            return redirect()->back()->with('error', 'Jenis produk tidak valid');
        }

        $cart = session()->get('cart', []);

        $key = $type . '_' . $id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity']++;
        } else {
            $cart[$key] = [
                'type' => $type,
                'id' => $id,
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'picture' => $product->picture ?? null
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function index()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function destroy($id)
{
    $cart = session()->get('cart', []);
    
    if(isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->back()->with('success', 'Item berhasil dihapus');
}

public function checkout(Request $request)
{
    $cart = session()->get('cart');
    session()->put('checkout_items', $cart);
    
    return redirect()->route('payment.show');
}
}
