@extends('layout')
@section('content')

<div class="card">
    <div class="card-body" style="font-size: 27px;margin-bottom: 1%;">
        Create Supplier
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

        <form action="/supplier" id="contactForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="supplier_name" class="form-label">Supplier Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="supplier_name" >
            </div>
            <div class="mb-3">
                <label for="supplier_email" class="form-label">Supplier Email</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="supplier_email" >
            </div>
            <div class="mb-3">
                <label for="supplier_phone" class="form-label">Supplier Phone</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="supplier_phone" >
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <a href="/supplier" class="btn btn-outline-dark">Cancel</a>
        </form>
    </div>
</div>

@endsection