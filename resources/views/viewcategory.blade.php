@extends('layout')
@section('content')
<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between" style="font-size:27px;margin-bottom: 1%;padding:1%">
            <span style="margin-right: 10px;"><i class="bi bi-list-check h3"></i> List of Category</span>
            <a href="/category/create" class="btn btn-primary">Create <i class="bi bi-plus-circle"></i></a>
        </div>

        @if (session('createdcategory'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('createdcategory') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('updatedcategory'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('updatedcategory') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('deletedcategory'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('deletedcategory') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body">
            <table class="table table-stripped text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $num = 1; ?>
                    @foreach($cat as $category)
                    <tr>
                        <th scope="row">{{ $num }}</th>
                        <td>{{ $category->catname }}</td>
                        <td>
                            <div class="d-flex flex-row" style="padding-left: 40%;">
                                <div class="p-2">
                                    <a href="/category/{{$category->id}}/edit" class="btn btn-outline-success"><i class="bi bi-wrench-adjustable"></i></a>
                                </div>
                                <div class="p-2">
                                    <form action="/category/{{$category->id}}" method="post">
                                        @csrf
                                        @Method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash3-fill"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <?php $num++; ?>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $cat->links() }}
    </div>
</div>
</div>
</div>

@endsection