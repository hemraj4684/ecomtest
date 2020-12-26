@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">
                        All Product
                        <a href="{{ route('product.create') }}" class="btn btn-primary">Create</a>

                     <div class="clearfix"></div>
                </div>
                <div class="panel-body">
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
                    <div class="table-responsive">
                        <table class="table table-responsive table-striped table-bordered table-hover no-margin">
                          <thead>
                            <tr>
                             <th>Serial No.</th>
                             <th>Product Name</th>
                             <th>Description</th>
                             <th>Amount</th>
                           </tr>
                         </thead>
                         <tbody>
                         <?php $i=1; ?>
                         @foreach(\App\Product::paginate(10) as $product)
                           <tr>
                             <td>{{$i++}}</td>
                             <td>{{$product->title}}</td>
                             <td>{{$product->desciption}}</td>
                             <td>{{$product->amount}}</td>
                           </tr>
                         @endforeach
                         </tbody>
                      </table>
                   </div>
                    {!! \App\Product::paginate(10)->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection