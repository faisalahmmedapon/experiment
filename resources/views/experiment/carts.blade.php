@extends('experiment.app')


@section('content')
    <div class="container">
        <div class="row">
           <div class="col-md-12">
            <a href="{{ route('remove') }}" class="btn btn-danger"> Remove All</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">QTY</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($carts) && $carts->count() > 0)
                    @foreach ($carts as $key => $cart)
                    <tr>

                        <td>{{ $key+1 }}</td>
                        <td>{{ $cart->product->name }}</td>
                        <td>${{ $cart->product->price }}</td>
                        <td>1</td>
                        <td>${{ $cart->product->price*1 }}</td>
                    </tr>
                    @endforeach

                    @else
                    @foreach ($products as $key => $product)
                    <tr>

                        <td>{{ $key+1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>${{ $product->price }}</td>
                        <td>1</td>
                        <td>${{ $product->price*1 }}</td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
           </div>
        </div>
    </div>
@endsection
