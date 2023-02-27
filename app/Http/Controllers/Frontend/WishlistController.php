<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function storewishlist(Request $request){
        if(Auth::check()){
            $product_id = $request->product_id;
            if( Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->exists() ){
                return response()->json([
                    'success' => false,
                    'message'=>'Product is already Added to Wishlist',
                    'data' => [],
                ],400);
            }else{
                $wishlist = new Wishlist();
                $wishlist->user_id = Auth::id();
                $wishlist->product_id = $product_id;
                $wishlist->save();

                return response()->json([
                    'success'=>true,
                    'message'=>'Product is Added to Wishlist',
                    'data'=>[],
                ],200);
            }
        }else{
            return response()->json([
                'success' => false,
                'message'=>'If you want to add this to Wishlist, Please Login or Register First!',
                'data' =>[],
            ],401);
        }
    }

    public function index(){
        $wishlist = Wishlist::where('user_id',auth()->user()->id)->get();
        return view('frontend.wishlist.index',compact('wishlist'));
    }

    public function removewishlist(Request $request){
        $item = Wishlist::findOrFail($request->id);
        $item->delete();

        return response()->json([
            'success'=>true,
            'message'=>'Wishlist Item Removed Successfully',
            'data'=>[],
        ],200);
    }

    public function checkWishlistCount(){
        if(Auth::check()){
            $wishlistCount = Wishlist::where('user_id',auth()->user()->id)->count();
            return response()->json([
                'count' => $wishlistCount
            ]);
        }else{
            return response()->json([
                'count' => 0
            ],404);
        }
    }
}
