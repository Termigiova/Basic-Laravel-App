@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="{{ url('getRequest') }}" method="POST">
            {{ csrf_field() }}

            <hr>

            <div class="row justify-content-start">
                <div class="col-4">
                    <h3>Select a store</h3>
                </div>
                <div class="form-group col-3">
                    {{--<label for="storeSelect">Select a store</label>--}}
                    <select class="form-control" id="storeSelect">
                        @foreach($shops as $shop)
                            <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr>

            <div class="row">
                <h3>Product catalog</h3>

                <div class="justify-content-center">
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-sm-4 my-3">
                                <div class="card text-center">
                                    <img class="card-img-top" src="http://getdrawings.com/image/pepe-frog-drawing-52.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="card-title">{{ $product->name }}</h5>
                                                <p class="card-text">$ {{ $product->price }}</p>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="col-form-label">Quantity</label>
                                                    <input class="form-control" type="number" min="1" max="99" value="1" name="quantityValue{{ $product->id }}">
                                                </div>
                                            </div>
                                        </div>

                                        <a type="submit" class="btn btn-primary getRequest" data-product="{{ $product->id }}">Buy</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
    <script src="js/products.js"></script>
@endsection