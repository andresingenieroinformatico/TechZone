<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with(['product.primaryImage'])
            ->get();

        $subtotal = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        $tax = $subtotal * 0.15; // 15% IVA
        $total = $subtotal + $tax;

        return view('cart.index', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        Gate::authorize('update', $cartItem);

        $request->validate(['quantity' => 'required|integer|min:1']);

        if ($cartItem->product->stock < $request->quantity) {
            return back()->with('error', 'No hay suficiente stock.');
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Carrito actualizado.');
    }

    public function destroy(CartItem $cartItem)
    {
        Gate::authorize('delete', $cartItem);
        $cartItem->delete();
        return back()->with('success', 'Producto eliminado del carrito.');
    }
}
