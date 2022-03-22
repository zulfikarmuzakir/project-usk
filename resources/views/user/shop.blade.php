@extends('layouts.app')

@section('content')
    <div class="container">
        @include('helper.success')
        @include('helper.error')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Store</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        @foreach ($items as $item)
                        <div class="col-3">
                            <div class="card-shop">
                                <div class="product-img">
                                    <img src="{{ asset('images/'.$item->image) }}" alt="{{ $item->name }}" style="width:100%; object-fit:cover">
                                </div>
                                <h1>{{ $item->name }}</h1>
                                <p class="price">{{ $item->price }}</p>
                                <p>{{ $item->description }}</p>
                                <p>Stock : {{ $item->stock }}</p>
                                <p>
                                    <form action="{{ route('user.addToCart') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="price" value="{{ $item->price }}">
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                    </form>
                                </p>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
.card-shop {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.price {
  color: grey;
  font-size: 22px;
}

.card-shop button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card-shop button:hover {
  opacity: 0.7;
}

</style>
@endpush