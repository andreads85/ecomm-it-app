<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer'
        ]);
        dd($validatedData);
    }
}
