<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @OA\Get(
     * path="/carts",
     * summary="List of carts",
     * description="Get the lits of carts",
     * operationId="cartList",
     * tags={"cart"},
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     *    required=false
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent()
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Unauthorized",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthenticated.")
     *        )
     *     )
     * )
     */
    public function index()
    {
        $carts = Cart::with('products')->get();
        return response()->json($carts);
    }
}
