<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Events\ProductEvent;
use Illuminate\Http\Request;
use App\Jobs\CreateProductJob;
use App\Mail\ProductCreatedMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\ProductResource;
use App\Notifications\ProductCreatedNotification;
use Illuminate\Support\Facades\Redis;

class ApiProductController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::all();
        $user = Auth::user();
        // $user->notify(new ProductCreatedNotification($products));
        return $this->apiResponse(ProductResource::collection($products), 'All Products!', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Product::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => 1
        ]);
        $user = Auth::user();
        // event(new ProductEvent($user,$data));

        CreateProductJob::dispatch($user, $data);
        return $this->apiResponse(ProductResource::make($data), 'Product Info!', 200);
    }

    /**
     * Display the specified resource.
     */
    // Redis Cashe service : how to implements this service
    public function show(string $id)
    {
        //     $product = Product::findOrFail($id);
        //     return $this->ApiResponse(ProductResource::make($product), 'product show successfully!', 200);

        $cachedProduct = Redis::get('product_' . $id);
        if (isset($cachedProduct)) {
            $product = json_decode($cachedProduct, FALSE);
            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from redis',
                'data' => $product,
            ]);
        } else {
            $product = Product::find($id);
            Redis::set('product_' . $id, $product);
            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from database',
                'data' => $product,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function test()
    {
        $product = Product::with('tags')->find(1);
        return response($product, 200);
    }
}
