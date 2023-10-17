<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index');
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
        ]);

        $newProduct = Product::create($data);

        return redirect(route('product.index'));
    }
}
