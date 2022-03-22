@extends('layouts.app')

@section('content')
    <div class="container">
        @include('helper.success')
        @include('helper.error')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Order</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Transaction Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                       <td>{{ $transaction->user->name }}</td>
                                       <td>{{ $transaction->transaction_code }}</td>
                                       <td>
                                             <form action="{{ route('canteen.order.approve', $transaction->id) }}" method="POST">
                                                  @csrf
                                                  @method('PUT')
                                                  <input type="hidden" name="transaction_code" value="{{ $transaction->transaction_code }}">
                                                  <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                             </form>
                                             <form action="{{ route('canteen.order.reject', $transaction->id) }}" method="POST">
                                                  @csrf
                                                  @method('PUT')
                                                  <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                             </form>
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