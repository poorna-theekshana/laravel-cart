<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function welcomeproducts()
    {
        $products = Product::all();
        return view('welcome', ['products' => $products]);
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
            $path = $request->file('image')->store('public/assets/images/product_images');
            $path = str_replace('public/', 'storage/', $path);

            $data['image'] = $path;
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
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/assets/images/product_images');
            $path = str_replace('public/', 'storage/', $path);
            $data['image'] = $path;
        } else {
            $data['image'] = $product->image;
        }

        $product->update($data);
        return redirect(route('product.index'))->with('success', 'Product updated succesfully');
    }

    public function delete(Product $product)
    {
        $product->delete();
        return redirect(route('product.index'))->with('success', 'Product deleted successfully');
    }

    public function index()
    {
        $products = Product::all();
        return view('product.index', ['products' => $products]);

    }
}
