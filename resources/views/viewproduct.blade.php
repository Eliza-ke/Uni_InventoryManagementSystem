@extends('layout')
@section('content')
<div>
    <div class="card">
        <div class="card-header" style="font-size:27px;margin-bottom: 1%;padding:1%">
            <i class="bi bi-list-check h3" style="margin-right: 10px;"></i>List of Products
        </div>

        @if (session('createdproduct'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('createdproduct') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        @if (session('updatedproduct'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('updatedproduct') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif


        @if (session('deletedproduct'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('deletedproduct') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="dropdown" style="margin-left: 2%;">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Category
            </button>
            <ul class="dropdown-menu">
                <li style="border-bottom: 1px solid #DDE6ED;padding:3px"><a class="dropdown-item" href="/product">View all</a></li>
                @foreach($categories as $category)
                <li style="border-bottom: 1px solid #DDE6ED;padding:3px"><a class="dropdown-item" href="/productIndex/{{ $category->id }}"> {{ $category->catname }}</a></li>
                @endforeach
            </ul>
        </div>
        <!-- <div class="dropdown">
            <select class="form-select" aria-label="Default select example" name="category_id">
                <option selected>Option Category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" ?>{{ $category->catname }}</option>
                @endforeach
            </select>
        </div> -->

        <div class="card-body">
            <?php $num = 1; ?>
            <table class="table table-stripped text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Suppliers</th>
                        <th scope="col">Description</th>
                        <th scope="col">Selling Price</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Images</th>
                        <th scope="col">Restock</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $num }}</th>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->categories->catname }}</td>
                        <td>{{ $product->suppliers->supplier_name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td><img src="../views/images/CbbrTLD8m35b8vHlIQgD25K9mOoWLvwBY0hYThcN.jpg" width="80" height="70" class="rounded float-start"> </td>
                        <td>
                            <div class="d-flex flex-row" style="padding-left: 5%;">
                                <div class="p-2">
                                    <a href="/purchaseorder/create/{{$product->id}}" style="text-decoration: none;"><i class="bi bi-database-fill-add h3"> </i>Order</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-row" style="padding-left: 5%;">
                                <div class="p-2">
                                    <a href="/product/{{$product->id}}/edit" class="btn btn-outline-success"><i class="bi bi-wrench-adjustable"></i></a>
                                </div>
                                <div class="p-2">
                                    <form action="/product/{{$product->id}}" method="post">
                                        @csrf
                                        @Method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></button>
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                    <?php $num++; ?>
                    @endforeach
                </tbody>
            </table>

        </div>
        {{ $products->links() }}
    </div>
</div>
</div>
</div>

@endsection