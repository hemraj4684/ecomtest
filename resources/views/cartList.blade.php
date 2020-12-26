@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">
                        All Cart Product
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
                             <th style="width:10%; text-align: center">Action</th>
                           </tr>
                         </thead>
                         <tbody>
                         <?php $i=1; ?>
                         @foreach($carts as $product)
                           <tr>
                             <td>{{$i++}}</td>
                             <td>{{$product->title}}</td>
                             <td>{{$product->desciption}}</td>
                             <td>{{$product->amount}}</td>
                             <td>
                             <form action="{{route('cart.destroy',$product->id)}}" method="post">
                             {{ csrf_field() }}
                             {{ method_field('DELETE') }}
                                <button class="btn btn-xs btn-danger delete_po" type="submit">
                                <i class="fa fa fa-trash-o" ></i>
                                </button>
                             </td>
                             </form>
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
<!-- modal start  -->
 <form action="" method="post" id="confirm">
<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delete Parmanently</h4>
      </div>

         {{ csrf_field() }}
         {{ method_field('DELETE') }}
          <div class="modal-body">
            <p>Are you sure you want to delete this?</p>
          </div>

      <div class="modal-footer">
      <input type="hidden" class="route_url">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-default">Delete</a>
      </div>
    </div>
   </div>
  </div>
  </form>
<!-- modal end -->
