@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Add New Banner</h4>

                    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="title-input">Title:</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title-input" name="title" placeholder="Enter banner title">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="link-input">Link:</label>
                                    <input type="text" class="form-control @error('link') is-invalid @enderror"
                                        id="link-input" name="link" placeholder="Enter banner link">
                                    @error('link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="type-input">Type:</label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type-input"
                                        name="type">
                                        <option value="event">Event</option>
                                        <option value="sale">Sale</option>
                                    </select>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="is-active-input">Active:</label>
                                    <select class="form-select @error('is_active') is-invalid @enderror"
                                        id="is-active-input" name="is_active">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('is_active')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="desktop-image-input">Desktop Image:</label>
                                    <input type="file" class="form-control @error('desktop_image') is-invalid @enderror" id="desktop-image-input" name="desktop_image">
                                    @error('desktop_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="mobile-image-input">Mobile Image:</label>
                                    <input type="file" class="form-control @error('mobile_image') is-invalid @enderror" id="mobile-image-input" name="mobile_image">
                                    @error('mobile_image')
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
                                    <button type="submit" class="btn btn-primary w-md">Create</button>
                                    <a href="{{ route('banners.index') }}" class="btn btn-secondary w-md">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
