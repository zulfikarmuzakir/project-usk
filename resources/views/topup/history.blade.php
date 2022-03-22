@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Topup History</h2>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary no-print" onclick="printPage()">Print</button>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Wallet Address</th>
                                    <th>Transaction Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>{{ $transaction->wallet->wallet_address }}</td>
                                        <td>{{ $transaction->transaction_code }}</td>
                                        <td>{{ number_format($transaction->total, 2, ",", ".") }}</td>
                                        <td>@if ($transaction->status == 3)
                                            <span class="badge bg-success">Approved</span>
                                            @elseif ($transaction->status == 2)
                                            <span class="badge bg-danger">Rejected</span>
                                            @else
                                            <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function printPage() {
            window.print();
        }
    </script>
@endpush