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
                            <h4 class="card-title">Categories</h4>
                            <a href="{{ route('subcategories.create') }}"
                                class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                <i class="bx bx-plus"></i> Add New Sub-Category
                            </a>
                        </div>
                        <hr>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Parent Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subCategories as $subCategory)
                                    <tr>
                                        <td>{{ $subCategory->id }}</td>
                                        <td>{{ $subCategory->name }}</td>
                                        <td>{{ $subCategory->category->name }}</td>
                                        <td>
                                            <a href="{{ route('subcategories.edit', $subCategory) }}"
                                                class="btn btn-soft-info waves-effect waves-light">
                                                <i class="bx bx-pencil"></i> Edit</a>
                                            <form action="{{ route('subcategories.destroy', $subCategory) }}"
                                                method="POST" style="display:inline;">
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
