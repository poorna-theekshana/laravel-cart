<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseDetailController extends Controller
{
    public function index()
    {
        // $data = PurchaseDetail::all();
        // return view("cart.purchaseInfo", ['purchases' => $data]);

        $purchases = PurchaseDetail::selectRaw('purchase_id, MAX(created_at) as date_created, SUM(price) as total_amount')
            ->groupBy('purchase_id')
            ->get();

        $purchaseDetails = PurchaseDetail::whereIn('purchase_id', $purchases->pluck('purchase_id'))->get();

        return view("cart.purchaseInfo", ['userpurchases' => $purchases, 'purchaseDetails' => $purchaseDetails]);

    }

    public function userindex()
    {
        $purchases = PurchaseDetail::where('user_id', Auth::user()->id)
            ->selectRaw('purchase_id, MAX(created_at) as date_created, SUM(price) as total_amount')
            ->groupBy('purchase_id')
            ->get();

        $purchaseDetails = PurchaseDetail::whereIn('purchase_id', $purchases->pluck('purchase_id'))->get();

        return view("cart.userpurchaseInfo", ['userpurchases' => $purchases, 'purchaseDetails' => $purchaseDetails]);
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
                'product_name' => $product->pdct_name,
                'description' => $product->pdct_description,
            ]);

            $selectedCartItem->delete();
        }

        return redirect(route('cart.index'))->with('success', 'Chekout is done!');
    }
}
