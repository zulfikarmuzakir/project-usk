@extends('layouts.app')

@section('content')
    <div class="container">
        @include('helper.success')
        @include('helper.error')
        <div class="row">
            <div class="col-md-12 bg-white p-4">
                <div class="card">
                    <div class="card-header bg-color-secondary">
                        <h2>Wallet</h2>
                    </div>
                    <div class="card-body">
                        <div class="card mb-4 bg-color-secondary" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Saldo</h5>
                              <p class="card-text">Rp {{ number_format($wallet->balance,2,',','.') }}</p>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection