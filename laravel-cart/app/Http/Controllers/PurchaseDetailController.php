<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseDetailController extends Controller
{
    public function index(){
        $data=PurchaseDetail::all();
        return view("cart.purchaseInfo",['purchases' => $data]);
    }

    public function userindex(){
        $purchase = PurchaseDetail::where('user_id', Auth::user()->id)->get();
        return view("cart.userpurchaseInfo",['userpurchases' => $purchase]);
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $product = UserCart::find($request->cartItemId);
        $selectedCartItems = UserCart::where('user_id', $user->id)->get();

        $generatedId = uniqid();

        foreach ($selectedCartItems as $cartItem) {
            $product = Product::find($cartItem->product_id);
            $selectedCartItem = UserCart::where('user_id', $user->id)
                ->where('product_id', $cartItem->product_id)
                ->first();

            PurchaseDetail::create([
                'purchase_id' => $generatedId,
                'user_id' => $user->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $product->pdct_price * $cartItem->quantity,
            ]);

            $selectedCartItem->delete();
        }

        return redirect(route('cart.index'))->with('success', 'Chekout is done!');
    }
}
