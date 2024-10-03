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
                            <h4 class="card-title">Blog Categories</h4>
                            <div class="d-flex">
                                <input type="text" id="storeFilter" class="form-control form-control-sm"
                                    placeholder="Filter by name">
                                <button id="clearFilter" class="btn btn-soft-primary waves-effect waves-light w-50"><i
                                        class="bx bx-undo"></i>Clear</button>
                            </div>
                            <a href="{{ route('blogcategories.create') }}"
                                class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                <i class="bx bx-plus"></i> Add New Category
                            </a>
                        </div>
                        <hr>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogcategories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('blogcategories.edit', $category->id) }}"
                                                class="btn btn-soft-info waves-effect waves-light">
                                                <i class="bx bx-pencil"></i> Edit</a>
                                            <form action="{{ route('blogcategories.destroy', $category->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-soft-danger waves-effect waves-light" onclick="return confirm('Are your sure')">
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
