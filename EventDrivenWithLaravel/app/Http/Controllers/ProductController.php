<?php

namespace App\Http\Controllers;

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

        return response($product, Response::HTTP_CREATED);
    }


    public function update(Product $product, Request $request)
    {
        $product->update(
          $request->only('title', 'image')
        );

        return response($product, Response::HTTP_ACCEPTED);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response($product, Response::HTTP_NO_CONTENT);

    }
}
