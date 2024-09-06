@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit user Item</h4>

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="label-input">Name :</label>
                                <input type="text" class="form-control" id="label-input" name="name" value="{{ $user->name }}" placeholder="Enter navbar item name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="link-input">Email :</label>
                                <input type="text" class="form-control" id="link-input" name="email" value="{{ $user->email }}" placeholder="Enter nav-item path name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="order-input">Password :</label>
                                <input type="number" class="form-control" id="order-input" name="password" value="{{ $user->password }}" placeholder="Enter order">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="order-input">Status :</label>
                                <select name="active" id="" class="form-select" value="{{ $user->active }}">
                                    <option value="" disabled>Select user status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-6">
                            <input type="hidden" name="role" value="user" />
                            <input type="hidden" name="company" value="TRM" />
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-12">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Update</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary w-md">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
