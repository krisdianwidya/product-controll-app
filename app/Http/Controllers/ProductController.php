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


        // if ($request->hasFile('image')) {

        //     foreach ($request->image as $img_product) {
        //         $fileName = time() . '.' . $img_product->getClientOriginalName();
        //         $img_product->storeAs('assets/uploads', $fileName, 'public');
        //         $arr_img[] = $fileName;
        //     }

        //     auth()->user()->products()->create([
        //         'title' => $request->title,
        //         'description' => $request->description,
        //         'price' => $request->price,
        //         'image' => json_encode($arr_img)
        //     ])->categories()->attach($request->categories);
        // }

        // return redirect(route('home'))->with('message', 'Stuff added succesfully');
    }
}
