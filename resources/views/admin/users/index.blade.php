@extends('layouts.app')

@section('content')
    <div class="container">
        @include('helper.success')
        @include('helper.error')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Users</h2>
                    </div>
                    <div class="card-body">
                        
                        <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUser">
                        New
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="newUser" tabindex="-1" aria-labelledby="newUserLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="newUserLabel">Create New User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" placeholder="John Doe" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="name">Email</label>
                                    <input type="email" class="form-control" placeholder="john.doe@gmail.com" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="name">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="mb-3">
                                    <label for="name">Password Confirmation</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                                <div class="mb-3">
                                    <label for="role">Role</label>
                                    <select name="role_id" class="form-select">
                                        <option value="1">Administrator</option>
                                        <option value="2">Bank Mini</option>
                                        <option value="3">Kantin</option>
                                        <option value="4">User</option>
                                    </select>
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
                        
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>No. </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.delete', ["id" => $user->id]) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        {{-- <div class="bg-white p-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>   --}}
    </div>
@endsection