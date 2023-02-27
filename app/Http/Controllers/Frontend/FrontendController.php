<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\View\Components\Alert;


class FrontendController extends Controller
{
    public function index(){
        $sliders = Slider::where('status','0')->get();
        $trendingProducts = Product::where('trending', '1')->latest()->take(15)->get();
        $newArrivalProducts = Product::latest()->take(14)->get();
        $featuredProducts = Product::where('featured', '1')->latest()->take(14)->get();
        return view('frontend.index',compact('sliders','trendingProducts','newArrivalProducts','featuredProducts'));
    }

    public function searchProducts(Request $request){
        if($request->search){
            $searchProducts = Product::where('name','LIKE','%'.$request->search.'%')->latest()->paginate(15);
            return view('frontend.pages.search', compact('searchProducts'));
        }else{
            return redirect()->back()->with('message','Empty Search');
        }
    }

    public function newArrival(){
        $newArrivalProducts = Product::latest()->take(16)->get();
        return view('frontend.pages.new-arrival',compact('newArrivalProducts'));
    }

    public function featuredProducts(){
        $featuredProducts = Product::where('featured', '1')->latest()->get();
        return view('frontend.pages.featured-products',compact('featuredProducts'));
    }

    public function categories(){
        $categories = Category::where('status','0')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_slug,Request $request){

        $category = Category::where('slug',$category_slug)->first();

        if ($category) {
            $filtered_brand = $request->brand;
            if($request->brand){
                $products = Product::where('category_id',$category->id)->where('brand',$request->brand)->get();
            }else{
                $products = $category->products()->get();
            }

            return view('frontend.collections.products.index', compact('products','category','filtered_brand'));
        }else{
            return redirect()->back();
        }
    }

    // public function productView(string $category_slug,string $product_slug){
    //     $category = Category::where('slug',$category_slug)->first();
    //     if($category){

    //         $product = $category->products()->where('slug',$product_slug)->where('status','0')->first();
    //         if($product){

    //             return view('frontend.collections.products.view', compact('product','category'));
    //         }else{
    //             return redirect()->back();
    //         }

    //     }else{
    //         return redirect()->back();
    //     }
    // }

    public function productView(string $category_slug,string $product_slug, int $colorId = null)
    {
        $category = Category::where('slug',$category_slug)->first();
        if($category){
            $product = $category->products()->where('slug',$product_slug)->where('status','0')->first();
            if($product){
                if($colorId){
                    $productColor = $product->productColors()->where('id',$colorId)->first();
                    if($productColor){
                        if($productColor->quantity == 0){
                            $status = 'outOfStock';
                        }else{
                            $status = 'inStock';
                        }
                    }else{
                        $status = null;
                    }
                }else{
                    $status = null;
                }
                return view('frontend.collections.products.view', compact('product','category','status'));
            }else{
                return redirect()->back();
            }

        }else{
            return redirect()->back();
        }
    }

    // public function storecart(Request $request){
    //     if(Auth::check()){
    //         $product_id = $request->product_id;
    //         $quantityCount = $request->quantity;
    //         $color_id = $request->color_id;
    //         if($product = Product::where('id',$product_id)->where('status','0')->first()){
    //             //Check for productColor Quantity and insert to cart
    //             if($product->productColors()->count() > 1){
    //                 $colorItem = $product->productColors()->where('id', $color_id)->first();
    //                 $productColorSelectedQuantity = $colorItem->quantity;
    //                 if($productColorSelectedQuantity != NULL){
    //                     return response()->json([
    //                         'success' => true,
    //                         'message'=>'Color Selected',
    //                         'data' =>[],
    //                     ],404);
    //                 }else{
    //                     return response()->json([
    //                         'success' => false,
    //                         'message'=>'Select Your Product Color',
    //                         'data' =>[],
    //                     ],404);
    //                 }
    //             }else{
    //                 if($product->quantity > 0){
    //                     if($product->quantity > $quantityCount){
    //                         //Insert Product to Cart
    //                         return response()->json([
    //                             'success' => true,
    //                             'message'=>'i ma add to cart without color inside',
    //                             'data' =>[],
    //                         ],200);

    //                     }else{
    //                         return response()->json([
    //                             'success' => false,
    //                             'message'=>'Only'.$product->quantity.' Quantity Available',
    //                             'data' =>[],
    //                         ],404);
    //                     }
    //                 }else{
    //                     return response()->json([
    //                         'success' => false,
    //                         'message'=>'Out of Stock',
    //                         'data' =>[],
    //                     ],404);
    //                 }
    //             }
    //         }else{
    //             return response()->json([
    //                 'success' => false,
    //                 'message'=>'Product does not exists',
    //                 'data' =>[],
    //             ],404);
    //         }

    //     }else{
    //         return response()->json([
    //             'success' => false,
    //             'message'=>'Please Login or Register to continue!',
    //             'data' =>[],
    //         ],401);
    //     }
    // }


    public function storecart(Request $request){
        if(Auth::check()){
            $product_id = $request->product_id;
            $quantityCount = $request->quantity;
            $color_id = $request->color_id;
            if($product = Product::where('id',$product_id)->where('status','0')->first()){
                //Check for productColor Quantity and insert to cart
                if($product->productColors()->count() > 1){
                    $colorItem = $product->productColors()->where('id', $color_id)->first();
                    if ($colorItem) {
                        $productColorSelectedQuantity = $colorItem->quantity;
                        if($productColorSelectedQuantity != NULL){
                            if(Cart::where('user_id',auth()->user()->id)
                                    ->where('product_id',$product_id)
                                    ->where('product_color_id',$color_id)
                                    ->exists())
                            {
                                return response()->json([
                                    'success' => false,
                                    'message'=>'Product Already Added',
                                    'data' =>[],
                                ],409);
                            }else{
                                $productColor = $product->productColors()->where('id',$color_id)->first(); 
                                if($productColor->quantity > 0){
                                    if($productColor->quantity > $quantityCount){
                                        //Insert Product to Cart
                                        Cart::create([
                                            'user_id' => auth()->user()->id,
                                            'product_id' => $product_id,
                                            'product_color_id' => $color_id,
                                            'quantity' => $quantityCount
                                        ]);
                                        return response()->json([
                                            'success' => true,
                                            'message'=>'Product Added to Cart',
                                            'data' =>[],
                                        ],200);
                
                                    }else{
                                        return response()->json([
                                            'success' => false,
                                            'message'=>'Only'.$productColor->quantity.' Quantity Available',
                                            'data' =>[],
                                        ],404);
                                    }
                                }else{
                                    return response()->json([
                                        'success' => false,
                                        'message'=>'Out of Stock',
                                        'data' =>[],
                                    ],404);
                                }        
                            }                       
                        }else{
                            return response()->json([
                                'success' => false,
                                'message'=>'Out of Stock, Select another Product Color',
                                'data' =>[],
                            ],404);
                        }
                    } else {
                        return response()->json([
                            'success' => false,
                            'message'=>'Selected Color Not Found',
                            'data' =>[],
                        ],404);
                    }
                }else{
                    if(Cart::where('user_id',auth()->user()->id)->where('product_id',$product_id)->exists()){
                        return response()->json([
                            'success' => false,
                            'message'=>'Product Already Added',
                            'data' =>[],
                        ],409);
                    }else{
                        if($product->quantity > 0){
                            if($product->quantity > $quantityCount){
                                //Insert Product to Cart
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $product_id,
                                    'quantity' => $quantityCount
                                ]);
                                return response()->json([
                                    'success' => true,
                                    'message'=>'Product Added to Cart Successfully',
                                    'data' =>[],
                                ],200);
        
                            }else{
                                return response()->json([
                                    'success' => false,
                                    'message'=>'Only'.$product->quantity.' Quantity Available',
                                    'data' =>[],
                                ],404);
                            }
                        }else{
                            return response()->json([
                                'success' => false,
                                'message'=>'Out of Stock',
                                'data' =>[],
                            ],404);
                        }
                    }    
                }
            }else{
                return response()->json([
                    'success' => false,
                    'message'=>'Product does not exists',
                    'data' =>[],
                ],404);
            }
    
        }else{
            return response()->json([
                'success' => false,
                'message'=>'Please Login or Register to continue!',
                'data' =>[],
            ],401);
        }
    }

    public function thankyou(){
        return view('frontend.thankyou.index');
    }

    
}
