@extends('layout')
@section('content')

<div class="card">
    <div class="card-body" style="font-size: 27px;margin-bottom: 1%;">
        Update Product
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
        <form action="/product/{{$product->id}}" id="contactForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="pname" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="pname" value="{{ old('pname', $product->product_name) }}">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" aria-label="Default select example" name="category_id">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id? 'selected':'' }} ?>{{ $category->catname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="supplier" class="form-label">Supplier</label>
                <select class="form-select" aria-label="Default select example" name="supplier_id">
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $supplier->id == $product->supplier_id? 'selected':'' }} ?>{{ $supplier->supplier_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class=" mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="price" value="{{ old('price', $product->price) }}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Stock</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="qty" value="{{ old('qty', $product->quantity) }}">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                <img src="../../public/storage/app/photo/{{ $product->image }}" alt="Image" width="80" height="70" class="rounded float-start">
            </div>

            <div class="mb-3">

                <input class="form-control" type="file" id="formFile" name="img" value="{{ old('img', $product->images) }}">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <a href="/product" class="btn btn-outline-dark">Cancel</a>
        </form>
    </div>
</div>

@endsection