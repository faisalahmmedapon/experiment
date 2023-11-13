@extends('experiment.app')


@section('content')


<div class="container">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 py-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{ $product->name }} </h5>
                        <h5 class="card-title"> ${{ $product->price }} </h5>
                        <a href="{{ route('addToCart', $product->id) }}" class="btn btn-primary">Add to Cart</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
