@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Store</h4>
                            <div class="d-flex"> <input type="text" id="storeFilter" class="form-control form-control-sm"
                                    placeholder="Filter by name">
                                <button id="clearFilter" class="btn btn-soft-primary waves-effect waves-light w-50"><i class="bx bx-undo"></i>Clear</button>
                            </div>
                            <a href="{{ route('store.create') }}"
                                class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                <i class="bx bx-plus"></i> Add New Store
                            </a>
                        </div>
                        <hr>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Store Image</th>
                                    <th>Store Website</th>
                                    <th>Created by</th>
                                    <th>Updated by</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stores as $store)
                                    <tr>
                                        <td>{{ $store->name }}</td>
                                        <td><img src="{{ asset('uploads/stores/' . $store->image) }}" width="100px"
                                                alt=""></td>
                                        <td>{{ $store->website }}</td>
                                        <td>{{ $store->creator ? $store->creator->name : '' }}</td>
                                        <td>{{ $store->updater ? $store->updater->name : '' }}</td>
                                        <td>{!! $store->formatted_categories !!}
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('store.edit', $store->id) }}"class="btn btn-soft-info waves-effect waves-light">
                                                <i class="bx bx-pencil"></i> Edit</a>
                                            <form action="{{ route('store.destroy', $store->id) }}" method="POST"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-soft-danger waves-effect waves-light"
                                                    onclick="return confirm('Are your sure')">
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
