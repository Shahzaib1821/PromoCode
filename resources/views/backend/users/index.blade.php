@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Users</h4>
                            <a href="{{ route('users.create') }}"
                                class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                <i class="bx bx-plus"></i> Add New User
                            </a>
                        </div>
                        <hr>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->company }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->active }}</td>

                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="btn btn-soft-info waves-effect waves-light">
                                                <i class="bx bx-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-soft-danger waves-effect waves-light">
                                                    <i class="bx bx-trash-alt"></i> Delete
                                                </button>
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
