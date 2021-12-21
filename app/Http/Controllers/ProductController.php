<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

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
        return view('dashboard')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer'
        ]);
        $product_id = $validatedData['product_id'];
        $user_id = $request->user()->id;
        $cart = Cart::where('user_id', $user_id)->first();
        if($cart) {
            $cart_id = $cart->id;
            if($cart->products()->where('product_id', $product_id)->first()) {
                $curr_qty = $cart->products()->where('product_id', $product_id)->first()->pivot->quantity;
                $curr_qty++;
                $cart->products()->updateExistingPivot($product_id, [
                    'quantity' => $curr_qty
                ]);
            } else {
                $cart->products()->attach($product_id);
            }
        } else {
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->save();
            $cart_id = $cart->id;
            $cart->products()->attach($product_id);
        }
        
        //return response('Hello World', 200);
        return response()->json([
            'Success' => 1,
            'message' => 'Prodotto inserito con successo'
        ]);
    }
}
