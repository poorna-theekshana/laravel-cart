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
        $user = Auth::user();
        $selectedCartItems = UserCart::where('user_id', $user->id)->get();

        $cartData = [];
        $totalAmount = 0;

        foreach ($selectedCartItems as $cartItem) {
            $product = Product::find($cartItem->product_id);
            $cartData[] = [
                'cartItemId' => $cartItem->id,
                'product' => $product,
                'quantity' => $cartItem->quantity,
            ];
            $totalAmount += $product->pdct_price * $cartItem->quantity;
        }

        return view('cart.viewcart', ['cartData' => $cartData, 'totalAmount' => $totalAmount]);
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

            if ($selectedProductItem->pdct_qty > 0) {
                if ($selectedCartItem) {
                    UserCart::updateOrCreate($data, [
                        'quantity' => $selectedCartItem->quantity + 1,
                    ]);
                } else {
                    UserCart::create([
                        'user_id' => $user->id,
                        'product_id' => $request->product_id,
                        'quantity' => 1,
                    ]);
                }

                $selectedProductItem->decrement('pdct_qty', 1);
                $selectedProductItem->save();

                return redirect()->route('welcome')->with('success', 'Item added to the cart succesfully!');
            } else {
                return redirect()->route('welcome')->with('warning', 'Selected item is out of stock!');
            }
        }

        return redirect()->route('welcome')->with('warning', 'Error occured while adding to the cart!');
    }

    public function delete(Request $request)
    {
        $product = UserCart::find($request->cartItemId);
        $product->delete();

        return redirect(route('cart.index'))->with('success', 'Product deleted succesfully');
    }
}
