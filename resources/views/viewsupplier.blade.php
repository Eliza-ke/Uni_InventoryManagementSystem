@extends('layout')
@section('content')
<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between" style="font-size:27px;margin-bottom: 1%;padding:1%">
            <span style="margin-right: 10px;"><i class="bi bi-list-check h3"></i> List of Supplier</span>
            <a href="/supplier/create" class="btn btn-primary">Create <i class="bi bi-plus-circle"></i></a>
        </div>

        <div class="card-body">
            <table class="table table-stripped text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Supplier Name</th>
                        <th scope="col">Supplier Email</th>
                        <th scope="col">Supplier Phone</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $num = 1; ?>
                    @foreach($suppliers as $supplier)
                    <tr>
                        <th scope="row">{{ $num }}</th>
                        <td>
                            <a href="/supplier/{{$supplier->id}}/edit" class="btn btn-outline-success"><i class="bi bi-wrench-adjustable"></i></a>
                        </td>
                        <td>{{ $supplier->supplier_name }}</td>
                        <td>{{ $supplier->supplier_email }}</td>
                        <td>{{ $supplier->supplier_phone }}</td>

                        <?php $num++; ?>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $suppliers->links() }}
    </div>
</div>
</div>
</div>
@endsection