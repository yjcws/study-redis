<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\CartService;

class CartController extends Controller
{
    public function index()
    {
        Auth::login(User::find(1));
        return view("product.magaha_zxr");
    }
    public function addCart(CartRequest $cartRequest,CartService $cartService)
    {
        $product = $cartRequest->input("product_id");
        $amount  = $cartRequest->input("amount");
        $user = Auth::id();
        return response()->json($cartService->addCart($product,$amount,$user));
    }

    public function decr(CartRequest $cartRequest,CartService $cartService)
    {
        $product = $cartRequest->input("product_id");
        $amount  = $cartRequest->input("amount");
        $user = Auth::user()->id;
        return response()->json($cartService->DecrCart($product,$amount,$user));
    }
}
