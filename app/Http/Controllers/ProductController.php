<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function getProduct(Product $product)
    {
        return response()->json($product);
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

    public function update(Request $request, Product $product)
    {
        $validateImg = false;
        if ($request->hasFile('image')) {
            $validateImg = $this->validate($request, [
                'image' => 'required|file|mimes:jpg,jpeg,bmp,png|max:10240|dimensions:max_height=4000,max_width=4000'
            ]);
        }

        $validate = $this->validate($request, [
            'name' => 'required|min:5',
            'price' => 'required|min:4|numeric',
            'description' => 'required|min:10',
        ]);

        if ($validate) {

            $imgProduct = $product->image;

            if ($validateImg) {

                if (Storage::exists('public/assets/uploads/' . $product->image)) {
                    Storage::delete('public/assets/uploads/' . $product->image);
                }

                $fileName = time() . '.' . $request->image->getClientOriginalName();
                $request->image->storeAs('assets/uploads', $fileName, 'public');

                $imgProduct = $fileName;
            }
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $imgProduct
            ]);

            return response()->json('ok');
        } else {
            return response()->json($this->errors());
        }
    }

    public function destroy(Product $product)
    {
        if (Storage::exists('public/assets/uploads/' . $product->image)) {
            Storage::delete('public/assets/uploads/' . $product->image);
        }

        $product->delete();

        return response()->json('ok');
    }
}
