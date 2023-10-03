<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Session;

use Stripe;

class HomeController extends Controller
{
    public function index(){

        $data= Product::paginate(6);
        $comments = Comment::orderby('id','desc')->get();
        $replies = Reply::all(); 
        return view('home.userPage',compact('data','comments','replies'));
    }

    public function redirect(){

        $user_type = auth()->user()->user_type;

        if ($user_type == 'admin') {

            $total_products = Product::all()->count();

            $total_orders = Order::all()->count();

            $total_customer = User::where('user_type','user')->get()->count();

            $orders = Order::all();

            $total_revenue = 0;

            foreach($orders as $order){
                $total_revenue = $total_revenue + $order->price;
            }

            $order_delivered = Order::where('delivery_status','delivered')->get()->count();

            $order_processing = Order::where('delivery_status','pending')->get()->count();
            
            return view('admin.home',compact('total_products','total_orders','total_customer','total_revenue','order_delivered','order_processing'));
        } else {

            $data = Product::paginate(6);
            $comments = Comment::orderby('id','desc')->get();
            $replies = Reply::all(); 
            return view('home.userPage',compact('data','comments','replies'));
        }
        
    }

    public function product_details($id){

        if(Auth::id()){

        $product = Product::find($id);

        return view('home.product_details',compact('product'));
                      }else{
                        return redirect('login');
                      }
    }

    public function add_to_cart(Request $request,$id){

        if(Auth::id()){
           $user = Auth::user();
           $product = Product::find($id);

           $existence_test = Cart::where('product_id',$id)->where('user_id',$user->id)->first();

           if($existence_test != null){
            global $cost;
            if($product->discount_price != null){
                $cost = $product->discount_price * $request->quantity;
            }else{
                $cost = $product->price * $request->quantity;
            }
            Cart::where('id',$existence_test->id)->update([
                'quantity'=>$existence_test->quantity + $request->quantity,
                'price'=>$existence_test->price + $cost,
            ]);

            return redirect()->back();

                                     }else{ 

          global $price;

            if($product->discount_price != null){
                $price = $product->discount_price * $request->quantity;
            }else{
                $price = $product->price * $request->quantity;
            }


            Cart::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'phone'=>$user->phone,
                'address'=>$user->address ,
                'product_title'=>$product->title,
                'price'=>$price ,
                'quantity'=>$request->quantity,
                'image'=>$product->image,
                'product_id'=>$product->id ,
                'user_id'=>$user->id,
            ]);

               
                                            }

        }else{
            return redirect('login');
        }

        return redirect()->back();
       
    }


    public function show_cart(){
        if(Auth::id()){
            $id = Auth::user()->id;

        $carts = Cart::where('user_id',$id)->get();

        return view('home.show_cart',compact('carts'));
        }
        else{
            return redirect('login');
        }
    }

    public function delete_from_cart($id){
        if(Auth::id()){
        Cart::find($id)->delete();
        return redirect()->back();
                      }else{
                        return redirect('login');
                      }
    }

    public function cash_on_delivery(){
        if(Auth::id()){
        $id = Auth::user()->id;

        $cart = Cart::where('user_id',$id)->get();
        
        foreach( $cart as $data ){
            Order::create([
                'name'=>$data->name ,
                'email'=>$data->email,
                'phone'=>$data->phone,
                'address'=>$data->address,
                'user_id'=>$data->user_id,
                'product_title'=>$data->product_title,
                'quantity'=>$data->quantity,
                'price'=>$data->price,
                'image'=>$data->image,
                'product_id'=>$data->product_id,
                'payment_status'=>'cash on delivery',
                'delivery_status'=>'pending',
            ]);
        $data->delete();
        }

        return redirect()->back()->with('message','Your order in processed, thank you for trust');
    
                       }else{
                        return redirect('login');
                       }
    }

    public function stripe($totalPrice)
    {   
        if(Auth::id()){
        return view('home.stripe',compact('totalPrice'));
                      }else{
                        return redirect('login');
                      }
    }


    public function stripePost(Request $request,$totalPrice){

        if(Auth::id()){

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    try{
        Stripe\Charge::create ([
                "amount" => $totalPrice*100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment" 
        ]);
        }
    catch(\Exception $e){
        return "sorry sir but we can't complete payment process, there is errors in payment server mostly,
        return the process later or pay cash on delivery.......thanks for your trust ";
    }    
    finally{

    }
        $id = Auth::user()->id;

        $cart = Cart::where('user_id',$id)->get();
        
        foreach( $cart as $data ){
            Order::create([
                'name'=>$data->name ,
                'email'=>$data->email,
                'phone'=>$data->phone,
                'address'=>$data->address,
                'user_id'=>$data->user_id,
                'product_title'=>$data->product_title,
                'quantity'=>$data->quantity,
                'price'=>$data->price,
                'image'=>$data->image,
                'product_id'=>$data->product_id,
                'payment_status'=>'Paid',
                'delivery_status'=>'pending',
            ]);
        $data->delete();
        }
      
        Session::flash('success', 'Payment successful!');
              
        return back();

                     }else{
                        return redirect('login');
                     }

    }

    public function show_my_orders(){
        if(Auth::id()){
            $id = Auth::id();
            $orders = Order::where('user_id',$id)->get();

            return view('home.order',compact('orders'));
        }
        else{
            return redirect('login');
        }
    }

    public function cancel_order($id){

        if(Auth::id()){

        Order::where('id',$id)->update([
            'delivery_status'=>"you canceled this order",
        ]);

        return redirect()->back();
                      }else{
                        return redirect('login');
                      }
    }


    public function add_comment(Request $request){

        if(Auth::id()){

            Comment::create([
                'name'=> Auth::user()->name,
                'comment'=>$request->comment,
                'user_id'=> Auth::user()->id,
            ]);
         return redirect()->back();

        }else{
            return redirect('login');
        }
    }

    public function add_reply(Request $request){
        if(Auth::id()){
        $user = Auth::user();
        Reply::create([
            'name'=>$user->name,
            'comment_id'=>$request->commentId,
            'reply'=>$request->reply,
            'user_id'=>$user->id,
        ]);

        return redirect()->back();
    }else{
        return redirect('login');
    }
    }


    public function search_product(Request $request){

        if(Auth::id()){
            $search_text = $request->search;

            $data = Product::where('title','LIKE',"%$search_text%")
            ->orWhere('description','LIKE',"%$search_text%")
            ->orWhere('price','LIKE',"%$search_text%")
            ->orWhere('category','LIKE',"%$search_text%")->get();

            return view('home.all_products',compact('data'));



        }else{
            return redirect('login');
        }


    }


    public function show_all_products(){
        if(Auth::id()){

            $data = Product::all();

            return view('home.all_products',compact('data'));




        }else{
            return redirect('login');
        }
    }
}
