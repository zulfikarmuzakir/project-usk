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
                            <form action="{{ route('admin.users.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
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
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                       </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection