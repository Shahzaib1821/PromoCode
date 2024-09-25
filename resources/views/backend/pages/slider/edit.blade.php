@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit Slider</h4>

                <form action="{{ route('sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="title">Title :</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $slider->title) }}" placeholder="Enter slider title" required>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="store_name">Store Name :</label>
                                <input type="text" class="form-control @error('store_name') is-invalid @enderror" id="store_name" name="store_name" value="{{ old('store_name', $slider->store_name) }}" placeholder="Enter store name" required>
                                @error('store_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="link">Link :</label>
                                <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link', $slider->link) }}" placeholder="Enter slider link" required>
                                @error('link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="image_path">Image :</label>
                                <input type="file" class="form-control @error('image_path') is-invalid @enderror" id="image_path" name="image_path">
                                @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if($slider->image_path)
                                    <div class="mt-2">
                                        <img src="{{ asset($slider->image_path) }}" alt="Slider Image" width="100">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="logo_path">Logo :</label>
                                <input type="file" class="form-control @error('logo_path') is-invalid @enderror" id="logo_path" name="logo_path">
                                @error('logo_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if($slider->logo_path)
                                    <div class="mt-2">
                                        <img src="{{ asset($slider->logo_path) }}" alt="Slider Logo" width="100">
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-12">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Update Slider</button>
                                <a href="{{ route('sliders.index') }}" class="btn btn-secondary w-md">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
