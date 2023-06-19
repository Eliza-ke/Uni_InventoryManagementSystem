@extends('layout')
@section('content')
<?php

use Carbon\Carbon;
?>

<div class="card" style="margin:1%">

    <div class="card-header d-flex justify-content-between" style="font-size:27px;margin-bottom: 1%;padding:1%">
        <p class="bi bi-receipt h3" style="margin-right: 10px;"> Invoice</p>
        <button onclick="exportToExcel()" class="btn btn-success">Export to Excel</button>
    </div>

    <div class="card-body">

        <table id="myTable" class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Purchase code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Order Quantity</th>
                    <th scope="col">Received</th>
                    <th scope="col">Remain</th>
                    <th scope="col">Ordered By</th>
                    <th scope="col">Ordered Date</th>
                    <th scope="col">Each Price</th>
                    <th scope="col">Total Cost</th>
                    <th scope="col">Received Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $num = 1; ?>
                @foreach($invoices as $invoice)
                <tr>
                    <td> {{ $num }}</td>
                    <td>#p{{ $invoice->purchaseorders->id}}</td>
                    <td>{{ $invoice->purchaseorders->products->product_name}}</td>
                    <td>{{ $invoice->purchaseorders->products->suppliers->supplier_name}}</td>
                    <td>{{ $invoice->purchaseorders->purchase_qty}}</td>
                    <td>{{ $invoice->received_quantity}}</td>
                    <td>{{ $invoice->remained_quantity}}</td>
                    <td>{{ $invoice->purchaseorders->orderedperson}}</td>
                    <td><?php $ordereddate = $invoice->purchaseorders->created_at;  ?>{{ Carbon::parse($ordereddate)->toDateString();}}</td>
                    <td>{{ $invoice->each_price }}</td>
                    <td>{{ $invoice->total_price}}</td>
                    <td><?php $receiveddate = $invoice->created_at; ?>{{Carbon::parse($receiveddate)->toDateString();}}</td>
                </tr>
                <?php $num++; ?>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-md-end">
            <button type="button" class="btn btn-warning position-relative ">
                Row
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $num }}
                </span>
            </button>
        </div>
    </div>
</div>

<script>
    function exportToExcel() {
        var wb = XLSX.utils.table_to_book(document.getElementById("myTable"), {
            sheet: "SheetJS"
        });
        var wbout = XLSX.write(wb, {
            bookType: "xlsx",
            type: "array"
        });
        var blob = new Blob([wbout], {
            type: "application/octet-stream"
        });
        saveAs(blob, "table.xlsx");
    }
</script>

@endsection