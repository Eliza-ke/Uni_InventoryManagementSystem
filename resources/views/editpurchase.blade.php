@extends('layout')
@section('content')

<div class="card">
    <div class="card-body" style="font-size: 27px;margin-bottom: 1%;">
        Update Purchase Order
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

        <form action="/purchaseorder/{{$purchase->id}}" id="contactForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="product_id" value="{{$purchase->product_id}}">
            <div class="mb-3">
                <span>
                    <h4>{{$purchase->products->product_name}}</h4>
                </span>
                <p>Category:<i> {{$purchase->products->categories->catname}} </i></p>
            </div>
            <div class="mb-3">
                <label for="reorder_quantity" class="form-label">Reorder Quantity</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="reorder_quantity" value="{{ old('reorder_quantity', $purchase->purchase_qty)}}">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <a href="/purchaseorder" class="btn btn-outline-dark">Cancel</a>
        </form>
    </div>
</div>

@endsection