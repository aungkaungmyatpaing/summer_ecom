<?php

namespace App\Http\Controllers\Frontend;

use Log;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\PlaceOrderMilable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\OrderFormRequest;

class CheckoutController extends Controller
{
    public function index(){
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        $totalProductAmount = 0;
        foreach($carts as $cartItem){
            $totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return view('frontend.checkout.index',compact('totalProductAmount'));
    }

    public function placeOrder(OrderFormRequest $request, $payment_mode = NULL , $payment_id = NULL){
        $validatedData = $request->validated();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'summer-'.Str::random(10),
            'fullname' => $validatedData['fullname'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'pincode' => $validatedData['pincode'],
            'address' => $validatedData['address'],
            'status_message' => 'in progress',
            'payment_mode' => $payment_mode ?? 'Cash on delivery',
            'payment_id' => $payment_id,
        ]);

        $carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach($carts as $cartItem){
            $orderItems = Orderitem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price
            ]);

            if($cartItem->product_color_id != NULL){
                $cartItem->productColor()->where('id',$cartItem->product_color_id)->decrement('quantity',$cartItem->quantity);
            }else{
                $cartItem->product()->where('id',$cartItem->product_id)->decrement('quantity',$cartItem->quantity);
            }
        }

        if($order && $orderItems){
            Cart::where('user_id', auth()->user()->id)->delete();
            try{
                $createdOrder = Order::findOrFail($order->id);
                Mail::to($createdOrder->email)->send(new PlaceOrderMilable($createdOrder));
            }catch(\Exception $e){
                // something went wrong
            }
            return redirect('/thank-you')->with('message','Order Placed Successfully');
        }else{
            return redirect('/checkout')->with('message','Oops, Something Went Wrong!');
        }
        
    }

    public function paidOnlineOrder(Request $request){
        $validatedData = $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:10|max:11',
            'pincode' => 'required|digits:6',
            'address' => 'required',
            'payment_id' => 'required',
        ]);
        if (array_key_exists('payment_id', $validatedData)) {
            $payment_id = $validatedData['payment_id'];
        } else {
            $payment_id = null;
        }
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'summer-'.Str::random(10),
            'fullname' => $validatedData['fullname'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'pincode' => $validatedData['pincode'],
            'address' => $validatedData['address'],
            'status_message' => 'in progress',
            'payment_mode' => 'Paid by PayPal',
            'payment_id' => $payment_id,
        ]);

            $carts = Cart::where('user_id', auth()->user()->id)->get();
            foreach($carts as $cartItem){
                $orderItems = Orderitem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_color_id' => $cartItem->product_color_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->selling_price
                ]);

                if($cartItem->product_color_id != NULL){
                    $cartItem->productColor()->where('id',$cartItem->product_color_id)->decrement('quantity',$cartItem->quantity);
                }else{
                    $cartItem->product()->where('id',$cartItem->product_id)->decrement('quantity',$cartItem->quantity);
                }
            }
        

        if($order && $orderItems){
            Cart::where('user_id', auth()->user()->id)->delete();

            try{
                $createdOrder = Order::findOrFail($order->id);
                Mail::to($createdOrder->email)->send(new PlaceOrderMilable($createdOrder));
            }catch(\Exception $e){
                // something went wrong
            }

            session()->flash('message', 'Transaction Success, Order Placed Successfully');

            return response()->json([
                'success' => true,
                'message'=>'Transaction Success, Order Placed Successfully',
                'data' =>[],
            ],201);
            //return redirect('/thank-you')->with('message','Transaction Success, Order Placed Successfully');
        }else{
            return response()->json([
                'success' => false,
                'message'=>'Oops, Something Went Wrong!',
                'data' =>[],
            ],500);
            //return redirect('/checkout')->with('message','Oops, Something Went Wrong!');
        }
    }
}
