@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Add New Admin User</h4>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('adminUser.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="label-input">Name :</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="label-input" name="name"
                                        placeholder="Enter your name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="link-input">Email :</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="link-input" name="email"
                                        placeholder="Enter your email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="order-input">Password :</label>
                                    <div class="input-group auth-pass-inputgroup">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="order-input">Role :</label>
                                    <select name="role" id="" class="form-select @error('role') is-invalid @enderror">
                                        <option value="admin">Admin</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="order-input">Company :</label>
                                    <input type="text" class="form-control @error('company') is-invalid @enderror" id="order-input" name="company"
                                        placeholder="Enter your company" value="TRM">
                                    @error('company')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <input type="hidden" name="active" value="1" />
                                <input type="hidden" name="is_deleted" value="0">
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-12">
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Create</button>
                                    <a href="{{ route('adminUser.index') }}" class="btn btn-secondary w-md">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
