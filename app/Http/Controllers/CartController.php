<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Cart,Product};
use Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = new Cart();
        $carts = $cart->viewCart();
        return view('cartList',compact('carts'));
    }

    public function store(Request $request)
    {
        $cart = new Cart();
        $saveYN = $cart->saveCart($request->all());
        if ($saveYN) { 
            Session::flash('message','Product added in cart Successfully');
        }
        else {
            Session::flash('error','Product not added Successfully');
        }
        $products = Product::where('cat_id',$request->cat_id)->get();
        return redirect()->route('get.product', ['id' => $request->cat_id]);
    }

    public function destroy($id)
    {
        Cart::destroy($id);
        Session::flash('message','Record deleted Successfully');
        return redirect()->back();	 
    }
}
