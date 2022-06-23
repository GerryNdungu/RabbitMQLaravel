<?php

namespace App\Http\Controllers;

use App\Jobs\ProductCreated;
use App\Jobs\ProductDeleted;
use App\Jobs\ProductUpdated;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(){
        return Product::all();
    }

    public function show(Product $product)
    {
        return Product::find($product);
    }

    public function store(Request $request)
    {
        $product = Product::create(
          $request->only('title','image')
        );
        ProductCreated::dispatch($product->toArray());
        return response($product, Response::HTTP_CREATED);
    }


    public function update(Product $product, Request $request)
    {
        $product->update(
          $request->only('title', 'image')
        );
        ProductUpdated::dispatch($product->toArray());
        return response($product, Response::HTTP_ACCEPTED);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        ProductDeleted::dispatch($product->toArray());
        return response($product, Response::HTTP_NO_CONTENT);

    }
}
