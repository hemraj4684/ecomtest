<?php

namespace App;
use Auth;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    public function viewCart()
    {
        $carts = $this->join('products','products.id', '=', 'cart.product_id')
                        ->where('user_id', Auth::id())->get();
        return $carts;
    }

    public function saveCart(array $data)
    {
        $this->product_id = $data['product'];
        $this->qty = $data['qty'];
        $this->user_id = Auth::id();
        return $this->save();
    }
}
