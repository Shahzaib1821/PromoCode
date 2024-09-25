@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Coupon</h4>

                    <form action="{{ route('coupons.update', $coupon->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Using PUT for updating -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="label-input">Name :</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="label-input" name="name" placeholder="Enter coupon's Name"
                                        value="{{ old('name', $coupon->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="coupon_code-input">Coupons Code :</label>
                                    <input type="text" class="form-control @error('coupon_code') is-invalid @enderror"
                                        id="coupon_code-input" name="coupon_code" placeholder="Enter coupon code"
                                        value="{{ old('coupon_code', $coupon->coupon_code) }}" required>
                                    @error('coupon_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="store-select">Stores :</label>
                                    <select name="store_id" id="store-select" class="form-select" required>
                                        @foreach ($stores as $store)
                                            <option value="{{ $store->id }}" {{ $coupon->store_id == $store->id ? 'selected' : '' }}>
                                                {{ $store->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('store_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="discounted_price">Discounted Price :</label>
                                    <input type="text" class="form-control @error('discounted_price') is-invalid @enderror"
                                        id="discounted_price" name="discounted_price"
                                        value="{{ old('discounted_price', $coupon->discounted_price) }}"
                                        placeholder="Enter discounted coupon price" required>
                                    @error('discounted_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="expiry_date">Expiry Date :</label>
                                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror"
                                    id="expiry_date" name="expiry_date"
                                    value="{{ old('expiry_date', $coupon->expiry_date ? $coupon->expiry_date->format('Y-m-d') : '') }}" required>
                                    @error('expiry_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="created_date">Created Date :</label>
                                    <input type="date" class="form-control @error('created_date') is-invalid @enderror"
                                        id="created_date" name="created_date"
                                        value="{{ old('created_date', $coupon->created_date ? $coupon->created_date->format('Y-m-d') : '') }}" required>
                                    @error('created_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="affiliated_link">Coupon Affiliated Link</label>
                                    <input type="text" class="form-control @error('affiliated_link') is-invalid @enderror"
                                        id="affiliated_link" name="affiliated_link"
                                        value="{{ old('affiliated_link', $coupon->affiliated_link) }}"
                                        placeholder="Enter coupon's affiliated link">
                                    @error('affiliated_link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="sort_order">Sort Order:</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                        id="sort_order" name="sort_order" value="{{ old('sort_order', $coupon->sort_order ?? 0) }}" min="0" required>
                                    @error('sort_order')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label for="description-textarea">Description :</label>
                                    <textarea name="description" id="description-textarea" class="form-control @error('description') is-invalid @enderror"
                                        rows="5" required>{{ old('description', $coupon->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="deal_exclusive" name="deal_exclusive"
                                        value="1" {{ $coupon->deal_exclusive ? 'checked' : '' }}>
                                    <label class="form-check-label" for="deal_exclusive">Deal Exclusive</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="verify"
                                        name="verify" value="1" {{ $coupon->verify ? 'checked' : '' }}>
                                    <label class="form-check-label" for="verify">Verify</label>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-12">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Update Coupon</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Summernote editors
            $('#meta-description').summernote({
                height: 200,
            });
            // $('#description-textarea').summernote({
            //     height: 200,
            // });
        });
    </script>
@endsection
