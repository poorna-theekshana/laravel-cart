<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function viewCart()
    {
        $user = Auth::user();
        $cart = $user->cart;

        return view('cart.view', ['cart' => $cart]);
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('id');
        $quantity = $request->input('pdct_qty');

        // Retrieve the product by its ID
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->route('welcome')->with('error', 'Product not found.');
        }

        // Check if the user already has a cart; if not, create one
        $user = Auth::user();
        $cart = $user->cart ?? new Cart();

        // Check if the product is already in the cart; if yes, update quantity
        $existingItem = $cart->items->where('product_id', $productId)->first();
        if ($existingItem) {
            $existingItem->quantity += $quantity;
            $existingItem->save();
        } else {
            // If not, create a new cart item
            $cartItem = new CartItem([
                'id' => $productId,
                'pdct_qty' => $quantity,
                // Add other necessary fields
            ]);
            $cart->items()->save($cartItem);
        }

        // Save the cart
        $user->cart()->save($cart);

        return redirect()->route('cart.view')->with('success', 'Product added to cart.');
    }

    public function removeFromCart(Request $request)
    {
        $cartItemId = $request->input('cart_item_id');

        // Retrieve the cart item by its ID
        $cartItem = CartItem::find($cartItemId);

        if ($cartItem) {
            // Delete the cart item
            $cartItem->delete();
            return redirect()->route('cart.view')->with('success', 'Product removed from cart.');
        }

        return redirect()->route('cart.view')->with('error', 'Product not found in the cart.');
    }
}
