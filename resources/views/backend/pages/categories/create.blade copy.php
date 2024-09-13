@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ isset($category) ? 'Edit Category' : 'Add New Category' }}</h4>

                    <form
                        action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($category))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="name">Name :</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Enter category name"
                                        value="{{ old('name', isset($category) ? $category->name : '') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="slug">Slug :</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug" placeholder="Enter category slug"
                                        value="{{ old('slug', isset($category) ? $category->slug : '') }}">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="status">Status :</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                        <option value="1"
                                            {{ old('status', isset($category) ? $category->status : '1') == '1' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="0"
                                            {{ old('status', isset($category) ? $category->status : '1') == '0' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="image">Image :</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image">
                                    @if (isset($category) && $category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image"
                                            class="img-fluid mt-2" style="max-height: 200px;">
                                    @endif
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="meta-title">Meta Title :</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                        id="meta-title" name="meta_title" placeholder="Enter meta title"
                                        value="{{ old('meta_title', isset($category) ? $category->meta_title : '') }}">
                                    @error('meta_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label for="meta-description">Meta Description :</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror summernote" id="meta-description"
                                        name="meta_description" rows="5">{{ old('meta_description', isset($category) ? $category->meta_description : '') }}</textarea>
                                    @error('meta_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="meta-keywords">Meta Keywords :</label>
                                    <select class="form-control select2 @error('meta_keywords') is-invalid @enderror"
                                        id="meta-keywords" name="meta_keywords[]" multiple="multiple">
                                        @foreach ($keywords as $keyword)
                                            <option value="{{ $keyword }}"
                                                {{ in_array($keyword, old('meta_keywords', isset($category) ? $category->meta_keywords : [])) ? 'selected' : '' }}>
                                                {{ $keyword }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('meta_keywords')
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

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#meta-description').summernote({
                height: 200,
            });
            $('#meta-keywords').select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });
        });
    </script>
@endsection
