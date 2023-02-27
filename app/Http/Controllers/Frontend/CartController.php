<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        $totalPrice = 0;
        return view('frontend.cart.index', compact('cart','totalPrice'));
    }

    public function checkCartCount(){
        if(Auth::check()){
            $cartCount = Cart::where('user_id',auth()->user()->id)->count();
            return response()->json([
                'count' => $cartCount
            ]);
        }else{
            return response()->json([
                'count' => 0
            ],404);
        }
    }

    public function update($itemId, Request $request){
        $quantity = $request->input('quantity');
        $cartData = Cart::where('id',$itemId)->where('user_id', auth()->user()->id)->first();
        if(!$cartData){
            return response()->json([
                'success' => false,
                'message'=>'Something Went Wrong!',
                'data' =>[],
            ],404);
        }
        $cartData->update(['quantity' => $quantity]);
        return response()->json([
            'success' => true,
            'message'=>'Quantity Updated',
            'data' =>[],
        ],200);
    }

    public function removecart(Request $request){
        $item = Cart::findOrFail($request->id);
        $item->delete();

        return response()->json([
            'success'=>true,
            'message'=>'Wishlist Item Removed Successfully',
            'data'=>[],
        ],200);
    }
}
