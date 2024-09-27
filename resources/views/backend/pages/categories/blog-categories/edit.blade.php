@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ isset($blogcategories) ? 'Edit Category' : 'Add New Category' }}</h4>

                    <form
                        action="{{ isset($blogcategories) ? route('blogcategories.update', $blogcategories->id) : route('blogcategories.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($blogcategories))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="name">Name :</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Enter category name"
                                        value="{{ old('name', isset($blogcategories) ? $blogcategories->name : '') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="status">Status :</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                        <option value="1"
                                            {{ old('status', isset($blogcategories) ? $blogcategories->status : '1') == '1' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="0"
                                            {{ old('status', isset($blogcategories) ? $blogcategories->status : '1') == '0' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-12">
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Save</button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-secondary w-md">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
