@extends('layout')
@section('content')

<div class="container" style="padding: 3% ;">
    <div style="float: right;">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Filter
            </button>
            <ul class="dropdown-menu">
                <li style="border-bottom: 1px solid #DDE6ED;padding:3px"><a class="dropdown-item" href="/dashboard">all year</a></li>
                <li style="border-bottom: 1px solid #DDE6ED;padding:3px"><a class="dropdown-item" href="{{ route('filter', ['year' => 2021]) }}"> 2021</a></li>
                <li style="border-bottom: 1px solid #DDE6ED;padding:3px"><a class="dropdown-item" href="{{ route('filter', ['year' => 2022]) }}"> 2022</a></li>
                <li style="border-bottom: 1px solid #DDE6ED;padding:3px"><a class="dropdown-item" href="{{ route('filter', ['year' => 2023]) }}"> 2023</a></li>
            </ul>
        </div>
    </div>


    <button type="button" class="btn btn-success" style="margin-right: 1%;padding:2%">
        <h4> Total Revenue by {{ $year }}</h4>
        <span>
            <h4> {{ $revenue }}</h4>
        </span>
    </button>

    <button type="button" class="btn btn-warning" style="margin-right: 1%;padding:2%">
        <h4> Total Cost by {{ $year }}</h4>
        <span>
            <h4> {{ $cost }}</h4>
        </span>
    </button>

    <button type="button" class="btn btn-primary" style="margin-right: 1%;padding:2%">
        <h4> Total Profit by {{ $year }}</h4>
        <span>
            <h4> {{ $profit = $revenue - $cost }}</h4>
        </span>
    </button>

</div>
</div>
@endsection