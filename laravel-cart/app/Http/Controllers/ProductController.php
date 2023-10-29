<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserCart;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function welcomeproducts()
    {
        $products = Product::all();
        return view('welcome', ['products' => $products, 'title' => "I just passed this from the backend "]);
    }

    public function index()
    {
        $products = Product::all();
        return view('product.index', ['products' => $products]);

    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pdct_name' => 'required',
            'pdct_description' => 'required',
            'pdct_price' => 'required | decimal:0,2',
            'pdct_qty' => 'required | numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imagePath = $imageFile->store('public/assets/images/product_images');
            $data['image'] = str_replace('public/', 'storage/', $imagePath);
        }

        $newProduct = Product::create($data);

        return redirect(route('product.index'));
    }
    public function edit(Product $product)
    {
        return view('product.edit', ['product' => $product]);
    }

    public function update(Product $product, request $request)
    {
        $data = $request->validate([
            'pdct_name' => 'required',
            'pdct_description' => 'required',
            'pdct_price' => 'required | decimal:0,2',
            'pdct_qty' => 'required | numeric',
        ]);

        $product->update($data);
        return redirect(route('product.index'))->with('success', 'Product updated succesfully');
    }

    public function delete(Request $request)
    {
        $product = UserCart::find($request->cartItemId);
        $product->delete();

        return redirect(route('cart.index'))->with('success', 'Product deleted succesfully');
    }
}
