<?php

namespace App\Http\Controllers;
use  App\Models\Category;
use  App\Models\Product;
use  App\Models\Order;
use Illuminate\Http\Request;
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;


class AdminController extends Controller
{
    public function viewCategory(){
        $data=Category::all();
        return view ('admin.category',compact('data'));
    }

    public function add_category(Request $request){
        $data= new Category;
        $data->name=$request->name;
        $data->save();
        return redirect()->back()->with('message','Category Sucessfully Added');
    }
    
    public function delete_category($id){
        $data=Category::find($id);
        $data->delete();
        return redirect()->back()->with('message','Category Sucessfully Deleted');
    }

    public function view_product(){
        $category=Category::all();
        return view ('admin.product',compact('category'));
    }

    public function add_product(Request $request){
        $product= new Product;
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->discount_price;
        $product->category=$request->category;
        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image=$imagename;
        $product->save();
        return redirect()->back()->with('message','Product Sucessfully Added');
    }

    public function show_product(){
        $product=Product::all();
        return view ('admin.show_product',compact('product'));
    }

    public function delete_product($id){
        $product=Product::find($id);
        $product->delete();
        return redirect()->back()->with('message','Product Sucessfully Deleted');
    }

    public function update_product($id){
        $product=Product::find($id);
        $category=Category::all();
        return view ('admin.update_product',compact('product','category'));
    }

    public function update_product_confirm(Request $request,$id){
        $product=Product::find($id);
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->category=$request->category;
        $product->discount_price=$request->discount_price;
        $image=$request->image;
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image=$imagename;
        }
       
        $product->save();
        return redirect()->back()->with('message','Product Sucessfully Updated');
    }

    public function order(){
        $order=Order::all();
        return view ('admin.order',compact('order'));
    }

    public function delivered($id){
        $order=Order::find($id);
        $order->delivery_status="Delivered";
        $order->payment_status="Paid";
        $order->save();
        return redirect()->back()->with('message','Order Sucessfully Updated');
    }

    public function print_pdf($id){
        $order=Order::find($id);
        $pdf=PDF::loadView('admin.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function send_email($id){
        $order=Order::find($id);
        return view ('admin.emailInfo',compact('order'));
    }  
    

    public function send_user_email(Request $request,$id){
        $order=Order::find($id);
        $details=[
            'greeting'=> $request->greeting,
            'firstline'=> $request->firstline,
            'body'=> $request->body,
            'button'=> $request->button,
            'url'=> $request->url,
            'lastline'=> $request->lastline,            
        ];

        Notification::send($order,new SendEmailNotification($details));
        return redirect()->back()->with('message','Product Sucessfully Added');
    }

    public function search_order(Request $request){
        $searchtext=$request->search;
        $order=Order::where('name','LIKE',"%$searchtext%")->orWHERE('phone','LIKE',"%$searchtext%")->orWHERE('product_title','LIKE',"%$searchtext%")->get();
        return view ('admin.order',compact('order'));
    }
    
    

    
}
