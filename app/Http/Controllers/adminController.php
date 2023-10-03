<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\File;
use PDF;

class adminController extends Controller
{
    public function view_category(){

        if(Auth::id()){
        $data = Category::all();
        return view('admin.category',compact('data'));
                      }else{
                        return redirect('login');
                      }
    }

    public function add_category(Request $request){

        if(Auth::id()){

        $add = Category::create([
            'category_name'=>$request->category_name,

        ]);

        return redirect()->back()->with('message','the category was added successfully');
                      }else{
                        return redirect('login');
                      }
        }
    
    public function delete_category($id){

        if(Auth::id()){
        $cat = Category::find($id)->delete();

        return redirect()->back()->with('message','Category is deleted successfully');
                      }else{
                        return redirect('login');
                      }
    }
    
    public function view_product(){
        if(Auth::id()){
        $category = Category::all();
        return view('admin.product',compact('category'));
                      }else{
                        return redirect('login');
                      }
    }
    
    public function add_product(Request $request){
        if(Auth::id()){
        $image = $request->image;
        $imagName = time().'.'.$image->getClientOriginalName();
        $request->image->move('ProductImage',$imagName);


        $data = Product::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$imagName,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'category'=>$request->category,
            'discount_price'=>$request->discount_price
        ]);

        return redirect()->back()->with('message','a product added successfully');
                      }else{
                        return redirect('login');
                      }
    }

    public function show_product(){

        if(Auth::id()){
        $product = Product::all();

        return view('admin.show_product',compact('product'));
                      }else{
                        return redirect('login');
                      }
    }

    public function delete_product($id,$photoName){

        if(Auth::id()){
        Product::find($id)->delete();
        File::delete(public_path('ProductImage/'.$photoName));
        return redirect()->back()->with('message','the product deleted successfully');
                      }else{
                        return redirect('login');
                      }
    }

    public function show_to_update($id){
        if(Auth::id()){
       $data = Product::find($id);
       $category = Category::all();
       return view('admin.update_product',compact('data','category'));
                      }else{
                        return redirect('login');
                      }
    }

    public function update_product(Request $request,$id,$old_image){

        if(Auth::id()){
        $image = $request->image;
        if($image){
            $imagName = time().'.'.$image->getClientOriginalName();
            File::delete(public_path('ProductImage/'.$old_image));
            $request->image->move('ProductImage',$imagName);
        }
        $old_product = Product::where('id',$id)->update([

            'title'=>$request->title,
            'description'=> $request->description,
            'price'=> $request->price,
            'quantity'=> $request->quantity,
            'category'=> $request->category,
            'discount_price'=> $request->discount_price,
            'image'=>$imagName
        ]);


        return redirect()->back()->with('message','the product updated successfully');
                      }else{
                        return redirect('login');
                      }


    }


    public function show_order(){
        if(Auth::id()){
        $orders = Order::all();

        return view('admin.order',compact('orders'));
                      }else{
                        return redirect('login');
                      }

    }

    public function delivered($id){

        if(Auth::id()){
        Order::find($id)->update([
            'delivery_status'=>'delivered',
            'payment_status'=>'paid'
        ]);

        return redirect()->back()->with('message','the order has delivered successfully');
                      }else{
                        return redirect('login');
                      }
    }

    public function print_pdf($id){

        if(Auth::id()){
        $order = Order::find($id);

        $pdf = FacadePdf::loadView('admin.pdf',compact('order'));

        return $pdf->download('order_details.pdf');
                      }else{
                        return redirect('login');
                      }

    }

    public function search_on_data(Request $request){
        if(Auth::id()){
        $dataSearch = $request->search;

        $orders = Order::where('name','LIKE',"%$dataSearch%")->orWhere('phone','LIKE',"%$dataSearch%")
        ->orWhere('product_title','LIKE',"%$dataSearch%")
        ->orWhere('payment_status','LIKE',"%$dataSearch%")
        ->orWhere('delivery_status','LIKE',"%$dataSearch%")->get();

        return view('admin.order',compact('orders'));
                      }else{
                        return redirect('login');
                      }

    }


}
