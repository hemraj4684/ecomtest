<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Schema, Storage, File, DB, Session;
use App\{Product, Category};

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('productView');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::get();
        return view('product', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $res = $product->validateProduct($request->all());
        
    	if ($res->fails()) {
            return redirect('product')
                        ->withErrors($res)
                        ->withInput();
        }
        else{
            $saveYN = $product->saveProduct($request->all());
        	if ($saveYN) { 
        		Session::flash('message','Record Saved Successfully');
        		return redirect('product');
        	}
        	else {
        		Session::flash('error','Record not Saved Successfully');
        		return redirect('product');	
        	}
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
                
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        Session::flash('message','Record deleted Successfully');
        return redirect('product');	 
    }
}
