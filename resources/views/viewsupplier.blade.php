@extends('layout')
@section('content')
<div>
    <div class="card">
        <div class="card-header" style="font-size:27px;margin-bottom: 1%;padding:1%">
            <i class="bi bi-list-check h3" style="margin-right: 10px;"></i>List of Supplier
        </div>

        <div class="card-body">
            <table class="table table-stripped text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Supplier Name</th>
                        <th scope="col">Supplier Email</th>
                        <th scope="col">Supplier Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $num = 1; ?>
                    @foreach($suppliers as $supplier)
                    <tr>
                        <th scope="row">{{ $num }}</th>
                        <td>{{ $supplier->supplier_name }}</td>
                        <td>{{ $supplier->supplier_email }}</td>
                        <td>{{ $supplier->supplier_phone }}</td>

                        <td>
                            <div class="d-flex flex-row" style="padding-left: 40%;">
                                <div class="p-2">
                                    <a href="/supplier/{{$supplier->id}}/edit" class="btn btn-outline-success"><i class="bi bi-wrench-adjustable"></i></a>
                                </div>
                                <div class="p-2">
                                    <form action="/supplier/{{$supplier->id}}" method="post">
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
    </div>
</div>
</div>
</div>
@endsection