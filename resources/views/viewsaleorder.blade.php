@extends('layout')
@section('content')
<?php

use Carbon\Carbon; ?>
<div class="card">
    <div class="card-header d-flex justify-content-between" style="font-size:27px;margin-bottom: 1%;padding:1%">
        <span class="bi bi-list-check h3" style="margin-right: 10px;"> List of Order by Customer</span>
        <button onclick="exportToExcel2()" class="btn btn-success">Export to Excel</button>

    </div>

    <div class="card-body">
        <table class="table table-stripped text-center" id="myTable2">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $num = 1; ?>
                @foreach($sales as $sale)
                <tr>
                    <th scope="row">{{ $num }}</th>
                    <td>{{ $sale->customer_name }}</td>
                    <td>{{ $sale->products->product_name }}</td>
                    <td>{{ $sale->saleorders_qty }}</td>
                    <td>{{ $sale->total_price}}</td>
                    <td><?php $ordereddate = $sale->created_at;  ?>{{ Carbon::parse($ordereddate)->toDateString();}}</td>
                    <?php $num++; ?>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
<script>
    function exportToExcel2() {
        var wb = XLSX.utils.table_to_book(document.getElementById("myTable2"), {
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