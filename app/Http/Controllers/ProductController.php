<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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

        $type = $request->file('image')->getClientOriginalExtension();
        $name = $request->file('image')->getClientOriginalName();
        $mime = $request->file('image')->getMimeType();
        $size = $request->file('image')->getSize();
        $newName = time() . rand(1, 10000) . uniqid() . '_' . $name;
        $request->file('image')->move('images', $newName);
        $databaseName = 'images/' . $newName;

        Product::create([
            'name' => $request->name,
            'image' => $databaseName,
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
        $oldProduct = Product::findOrFail($id);

        return view('product.edit', compact('oldProduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {

        $oldProduct = Product::FindOrFail($id);
        if (Storage::exists($oldProduct->image)) {
            Storage::delete($oldProduct->image);
        }
        Product::where('id', $id)->update([
            'name' => $request->name,
            'image' => $request->file('image')->store('image'),
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

    public function translate(Request $request)
    {
        if (in_array($request->language, ['en', 'ar'])) {
            Session::put('locale', $request->language);
        }
        return redirect()->back();
    }
}
