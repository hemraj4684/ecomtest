<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class CategoryController extends Controller
{
    public function getProduct($id)
    {
        $products = Product::where('cat_id',$id)->get();
        return view('productList', compact('products'));
    }
}
