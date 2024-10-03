@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Manage Coupons</h4>
                            <div class="d-flex">
                                <input type="text" id="storeFilter" class="form-control form-control-sm"
                                    placeholder="Filter by name">
                                <button id="clearFilter" class="btn btn-soft-primary waves-effect waves-light w-50"><i
                                        class="bx bx-undo"></i>Clear</button>
                            </div>
                            <a href="{{ route('coupons.create') }}"
                                class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                <i class="bx bx-plus"></i> Add New Coupon
                            </a>
                        </div>
                        <hr>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Store</th>
                                    <th>Sort Order</th>
                                    <th>Status</th>
                                    <th>Created by</th>
                                    <th>Updated by</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->name }}</td>
                                        <td>{{ $coupon->coupon_code }}</td>
                                        <td>{{ $coupon->store->name }}</td>
                                        <td>{{ $coupon->sort_order }}</td>
                                        <td>{{ $coupon->status ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ $coupon->creator ? $coupon->creator->name : '' }}</td>
                                        <td>{{ $coupon->updater ? $coupon->updater->name : '' }}</td>
                                        <td>
                                            <a href="{{ route('coupons.edit', $coupon) }}"
                                                class="btn btn-soft-info waves-effect waves-light">
                                                <i class="bx bx-pencil"></i> Edit</a>
                                            <form action="{{ route('coupons.destroy', $coupon) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-soft-danger waves-effect waves-light"
                                                    onclick="return confirm('Are You Sure ?')">
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
