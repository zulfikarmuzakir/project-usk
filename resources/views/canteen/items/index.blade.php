@extends('layouts.app')

@section('content')
    <div class="container">
        @include('helper.success')
        @include('helper.error')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Items
                    </div>
                    <div class="card-body">

                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newUser">
                            New
                        </button>
                        <div class="modal fade" id="newUser" tabindex="-1" aria-labelledby="newUserLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="newUserLabel">Insert New Item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            <form action="{{ route('canteen.items.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name">Image</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" name="price">
                                    </div>
                                    <div class="mb-3">
                                        <label for="stock">Stock</label>
                                        <input type="number" class="form-control" name="stock">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            </div>
                            </div>
                        </div>

                       <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td><img src="{{ asset('images/'.$item->image) }}" style="width: 100px" alt=""></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editItem-{{ $item->id }}">
                                                Edit
                                            </button>
                                            <form action="{{ route('canteen.items.delete', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            <div class="modal fade" id="editItem-{{ $item->id }}" tabindex="-1" aria-labelledby="editItemLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="editItemLabel">Insert New Item</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                <form action="{{ route('canteen.items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name">Image</label>
                                                            <input type="file" class="form-control" name="image">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" name="name" value="{{ $item->name }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="description">Description</label>
                                                            <textarea class="form-control" name="description">{{ $item->description }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="price">Price</label>
                                                            <input type="number" class="form-control" name="price" value="{{ $item->price }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="stock">Stock</label>
                                                            <input type="number" class="form-control" name="stock" value="{{ $item->stock }}">
                                                        </div>
                                                    </div>
                    
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                                </div>
                                                </div>
                                            </div>
                                            
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