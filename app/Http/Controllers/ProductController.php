<?php

namespace App\Http\Controllers;

use Dotenv\Util\Str;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        Product::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => 1
        ]);
        return back()->with('success', 'product added successfully!');
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
        $oldProduct =Product::findOrFail($id);

        return view('product.edit',compact('oldProduct' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        Product::where('id',$id)->update([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => 1,
        ]);
        return redirect('product/index')->with('success', 'product Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return back();
    }
}
