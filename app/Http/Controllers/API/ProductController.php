<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $product_id = $validatedData['product_id'];
        $user_id = $request->user()->id;
        $cart = Cart::where('user_id', $user_id)->first();
        if($cart) {
            $cart_id = $cart->id;
            if($cart->products()->where('product_id', $product_id)->first()) {
                $curr_qty = $cart->products()->where('product_id', $product_id)->first()->pivot->quantity;
                $curr_qty++;
                $cart->products()->updateExistingPivot($product_id, [
                    'quantity' => $curr_qty,
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ]);
            } else {
                $cart->products()->attach($product_id);
                Log::channel('cart_mods')->info('Aggiunto prodotto(id:'. $product_id .') al carrello(id:'. $cart_id .')');
            }
        } else {
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->save();
            $cart_id = $cart->id;
            Log::channel('cart_creations')->info('Creato un nuovo carrello(id:'. $cart_id .')');
            $cart->products()->attach($product_id);
            Log::channel('cart_mods')->info('Aggiunto prodotto(id:'. $product_id .') al carrello(id:'. $cart_id .')');
        }
        
        //return response('Hello World', 200);
        return response()->json([
            'Success' => 1,
            'message' => 'Prodotto inserito con successo',
            'product_name' => Product::where('id', $product_id)->first()->name
        ]);
    }

    public function removeFromCart(Request $request)
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
                $cart->products()->updateExistingPivot($product_id, [
                    'deleted_at' => \Carbon\Carbon::now()->toDateTimeString()
                ]);
                Log::channel('cart_mods')->info('Rimosso prodotto(id:'. $product_id .') dal carrello(id:'. $cart_id .')');
            }
        }

        return response()->json([
            'Success' => 1,
            'message' => 'Prodotto eliminato con successo'
        ]);
    }
}
