@extends('layouts.app')

@section('content')
<div class="container">
@if(session()->has('message'))
<div class="alert alert-success" role="alert">
    {{session()->get('message')}}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger" role="alert">
    {{session()->get('error')}}
</div>
@endif
<div class="row">
@foreach ($products as $product)
    <div class="col-4">
        <div class="card" style="width: 18rem;">
        <img src="{{getenv('APP_URL').'/storage/'.$product->image_path}}" class="img-fluid img-thumbnail" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{$product->title}}</h5>
            <p class="card-text">{{$product->desciption}}</p>
            <h5 class="card-title"><i class="fa fa-rupee fa-lg"></i>{{$product->amount}}</h5>
            <form action="{{route('cart.store')}}" method='post'>
                @csrf
                <input type="hidden" name="amount" value="{{ $product->amount }}">
                <input type="hidden" name="product" value="{{ $product->id }}">
                <input type="hidden" name="cat_id" value="{{ $product->cat_id }}">
                <div class="row g-3">
                    <div class="col">
                        <button class="btn btn-primary" name="add_to_cart" type="submit" value='cart'>Add To Cart</button>
                    </div>  
                    <div class="col">
                        <input type="text" class="form-control" placeholder="qty" aria-label="qty" name='qty' value=1>
                    </div>
                </div> 
            </form>
        </div>
        </div>
    </div>
@endforeach
</div>
</div>
@endsection