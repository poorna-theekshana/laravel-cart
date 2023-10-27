<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = CartItem::all();
        return view('cart.viewcart', ['cartItems' => $cartItems]);
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('id');
        $productName = $request->input('pdct_name');
        $quantity = $request->input('pdct_qty');
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->route('welcome')->with('error', 'Product not found.');
        }

        $user = Auth::user();
        $cart = $user->cart ?? new Cart();
        $cart->user_id = $user->id;
        $cart->save();

        $cartItem = new CartItem();
        $cartItem->cart_id = $cart->id;
        $cartItem->product_id = $productId;
        $cartItem->quantity = $quantity;
        $cartItem->save();

        return redirect()->route('cart.cartview');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
