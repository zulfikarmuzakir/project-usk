@extends('layouts.app')

@section('content')
    <div class="container">
        @include('helper.success')
        @include('helper.error')
        <div class="row">
            <div class="col-md-12 bg-white p-4">
                <div class="card">
                    <div class="card-header">
                        <h2>Topup</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bank.topup.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Wallet Address</label>
                                <input type="text" class="form-control" name="wallet_address">
                            </div>
                            <div class="form-group mb-3">
                                <label for="amount">Amount</label>
                                <input type="integer" class="form-control" name="amount">
                            </div>

                            <button type="submit" class="btn btn-primary">Topup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
