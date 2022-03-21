@extends('layouts.app')

@section('content')
    <div class="container">
        @include('helper.success')
        @include('helper.error')
        <div class="row">
            <div class="col-md-12 bg-white p-4">
                <div class="card">
                    <div class="card-header">
                        <h2>Wallet</h2>
                    </div>
                    <div class="card-body">
                        <div class="card mb-4" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Saldo</h5>
                              <p class="card-text">Rp {{ number_format($wallet->balance,2,',','.') }}</p>
                            </div>
                          </div>
                        <form action="{{ route('user.topup.request') }}" method="POST">
                            @csrf
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