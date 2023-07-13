<?php

use Carbon\Carbon; ?>
@extends('layout')
@section('content')

<div class="card">
    <div class="card-header" style="font-size:27px;margin-bottom: 1%;padding:1%">
        <i class="bi bi-list-check h3" style="margin-right: 10px;"></i> List of Purchase Order
    </div>

    <div class="card-body">
        <table class="table table-stripped text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th></th>
                    <th scope="col">Purchase code</th>
                    <th scope="col">Product</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Order </th>
                    <th scope="col">Received </th>
                    <th scope="col">Ordered By</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Status</th>
                    <th scope="col"> Delivered Product </th>
                </tr>
            </thead>
            <tbody>
                <?php $num = 1; ?>
                @foreach($purchaseorder as $purchase)
                <tr>
                    <th> {{ $num }}</th>
                    <td>
                        <div class="d-flex flex-row">
                            <div class="p-2">
                                <a href="/purchaseorder/{{$purchase->id}}/edit"><i class="bi bi-wrench-adjustable" style="color: green;"></i></a>
                            </div>
                            <div class="p-2">
                                <form action="/purchaseorder/{{$purchase->id}}" method="post">
                                    @csrf
                                    @Method('DELETE')
                                    <button type="submit" style="border:none"><i class="bi bi-trash3-fill" style="color:red"></i></button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td>#p{{ $purchase->id }}</td>
                    <td>{{ $purchase->products->product_name }}</td>
                    <td>{{ $purchase->products->suppliers->supplier_name }}</td>
                    <td>{{ $purchase->purchase_qty }}</td>
                    <td>{{ $purchase->received_qty }}</td>
                    <td>{{ $purchase->orderedperson }}</td>
                    <td><?php $dateTime = $purchase->created_at ?>
                        {{ Carbon::parse($dateTime)->toDateString(); }}
                    </td>
                    <td><span @if($purchase->status == 'completed')
                            class="badge rounded-pill text-bg-success"
                            @elseif($purchase->status == 'remaining')
                            class="badge rounded-pill text-bg-warning"
                            @else
                            class="badge rounded-pill text-bg-danger"
                            @endif >
                            {{ $purchase->status }}
                        </span>
                    </td>
                    <td>
                        @if($purchase->status == 'completed')
                        <button type="button" class="btn btn-secondary" disabled>Delivered</button>
                        @else
                        <button class="btn btn-primary showAlert" data-id="{{ $purchase->id }}" data-pid="{{ $purchase->products->id }}" data-name=" {{ $purchase->products->product_name }}">Delivered</button>
                        @endif
                    </td>
                </tr>
                <?php $num++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $purchaseorder->links() }}
</div>

<div class="modal" id="alertModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delivered</h5>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form id="alertForm" method="POST" action="/invoice">
                @csrf

                <div class="modal-body">
                    <input type="hidden" id="alertId" name="purchase_id">
                    <input type="hidden" id="alertpId" name="product_id">

                    <div class="form-group">
                        <label for="product">Product:</label>
                        <input type="text" class="form-control" id="inputName" name="inputName" readonly>
                    </div>
                    <div class="form-group">
                        <label for="received_quantity">Received Quantity:</label>
                        <input type="text" class="form-control" id="inputData" name="received_quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="remained_quantity">Remaining Quantity:</label>
                        <input type="text" class="form-control" id="inputData" name="remained_quantity" required>
                    </div>
                    <div class="form-group">
                        <label for="each_price">Per Price:</label>
                        <input type="text" class="form-control" id="inputData" name="each_price" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.showAlert').click(function() {
            var id = $(this).data('id');
            var pid = $(this).data('pid');
            var name = $(this).data('name');

            // Set the ID value in the modal form
            $('#alertId').val(id);
            $('#alertpId').val(pid);
            $('#inputName').val(name);

            // Show the alert modal
            $('#alertModal').modal('show');
        });

    });
</script>
@endsection