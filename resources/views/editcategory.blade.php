@extends('layout')
@section('content')

<div class="card">
    <div class="card-body" style="font-size: 27px;margin-bottom: 1%;">
        Update Category
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

        <form action="/category/{{$category->id}}" id="contactForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="catname" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="category" value="{{ old('category', $category->catname)}}">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <a href="/category" class="btn btn-outline-dark">Cancel</a>
        </form>
    </div>
</div>

@endsection