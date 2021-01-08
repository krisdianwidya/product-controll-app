<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function loadView()
    {
        return view('products.products');
    }

    public function getProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {

        if ($this->validate($request, [
            'name' => 'required|min:5',
            'price' => 'required|min:4|numeric',
            'description' => 'required|min:10',
            'image' => 'required|file|mimes:jpg,jpeg,bmp,png|max:10240|dimensions:max_height=4000,max_width=4000'
        ])) {
            if ($request->hasFile('image')) {


                $fileName = time() . '.' . $request->image->getClientOriginalName();
                $request->image->storeAs('assets/uploads', $fileName, 'public');


                $product = Product::create([
                    'name' => $request->name,
                    'price' => $request->price,
                    'description' => $request->description,
                    'image' => $fileName
                ]);

                return response()->json('ok');
            }
        } else {
            return response()->json($this->errors());
        }
    }
}
