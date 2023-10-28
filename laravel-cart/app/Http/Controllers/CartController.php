<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = UserCart::all();
        return view('cart.viewcart', ['cartItems' => $cartItems]);
    }

    public function addToCart(Request $request)
    {
        $user = Auth::user();

        if ($user['id'] && $request['product_id'] && $request['quantity']) {
            $selectedCartItem = UserCart::where('user_id', $user->id)
                ->where('product_id', $request->product_id)
                ->first();

            $selectedProductItem = Product::where('id', $request->product_id)
                ->first();

            $data = [
                'user_id' => $user->id,
                'product_id' => $request->product_id,
            ];

            UserCart::updateOrCreate($data, [
                'quantity' => $selectedCartItem->quantity + 1,
            ]);

            $selectedProductItem->decrement('pdct_qty', 1);
            $selectedProductItem->save();

            return redirect()->route('welcome')->with('success', 'Item added to the cart succesfully!');
        }

        return redirect()->route('welcome')->with('warning', 'Error occured while adding to the cart!');
    }

    // public function store(Request $request)
    // {
    //     // Validate the incoming request data
    //     $data = $request->validate([
    //         'user_id' => 'required|numeric',
    //         'product_id' => 'required|numeric',
    //         'quantity' => 'required|numeric',
    //     ]);

    //     // Create a new user cart record
    //     UserCart::create($data);

    //     return redirect()->route('cart.view')->with('success', 'Item added to the cart successfully.');
    // }

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
