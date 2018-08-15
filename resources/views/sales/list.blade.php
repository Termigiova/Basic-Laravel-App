@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <h3>List of sales</h3>
        </div>

        <div class="row">
            <table class="table table-hover table-bordered table-striped">
                <thead class="thead-dark">
                <tr>
                    <th class="">User name</th>
                    <th scope="">Shop name</th>
                    <th scope="">Date</th>
                    <th>Product name</th>
                    <th>Product price</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <th>{{ $sale->userName }}</th>
                        <th>{{ $sale->shopName }}</th>
                        <th>{{ $sale->saleDate }}</th>
                        <th>{{ $sale->productName }}</th>
                        <th>${{ $sale->productPrice }}</th>
                        <th>{{ $sale->quantity }}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection