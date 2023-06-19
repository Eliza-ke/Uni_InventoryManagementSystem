@extends('layout')
@section('content')

<div class="card">
    <div class="card-body" style="font-size: 27px;margin-bottom: 1%;">
        Reorder
    </div>
</div>
<div class="card" style=" background:#EDF1D6">
    <div class="card-body" style="margin:2%;">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="/purchaseorder" id="contactForm" method="POST" enctype="multipart/form-data">
            @csrf
            
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <div class="mb-3">
                <span><h4>{{$product->product_name}}</h4></span>
                <p>Category:<i> {{$product->categories->catname}} </i></p>
            </div>
            <div class="mb-3">
                <label for="reorder_quantity" class="form-label">Reorder Quantity</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="reorder_quantity">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <a href="/product" class="btn btn-outline-dark">Cancel</a>
        </form>
    </div>
</div>

@endsection