@extends('layouts.app')

@section('content')
    <div class="container">
        @include('helper.success')
        @include('helper.error')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-color-secondary">
                        <h2>Cart</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Item</th>
                                    <th>Item Price</th>
                                    <th>Quantity</th>
                                    <th>Transaction Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cart->item->name }}</td>
                                        <td>Rp {{ number_format($cart->item->price, "2", ',', '.') }}</td>
                                        <td>{{ $cart->quantity }}</td>
                                        <td>Rp {{ number_format($cart->total, "2", ",", ".") }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div>
                            <h3>Total: Rp {{ number_format($total_price, '2', ',', '.') }}</h3>

                            <form action="{{ route('user.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn bg-color-primary">Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection