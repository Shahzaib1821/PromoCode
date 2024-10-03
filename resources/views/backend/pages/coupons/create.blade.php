@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Create New coupons</h4>

                    <form action="{{ route('coupons.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="label-input">Name :</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="label-input" name="name" placeholder="Enter coupons Name" required>
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
                                        id="coupon_code-input" name="coupon_code" placeholder="Enter coupons code" required>
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
                                            <option value="{{ $store->id }}">{{ $store->name }}</option>
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
                                    <input type="text"
                                        class="form-control @error('discounted_price') is-invalid @enderror"
                                        id="discounted_price" name="discounted_price"
                                        placeholder="Enter discounted coupons price" required>
                                    @error('discounted_price')
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
                                        id="created_date" name="created_date" required>
                                    @error('created_date')
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
                                        id="expiry_date" name="expiry_date" required>
                                    @error('expiry_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="affiliated_link">Coupon Affiliated Link</label>
                                    <input type="text"
                                        class="form-control @error('affiliated_link') is-invalid @enderror"
                                        id="affiliated_link" name="affiliated_link"
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
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="sort_order">Sort Order:</label>
                                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                        id="sort_order" name="sort_order" min="0" required>
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
                                        rows="5" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 mb-4">
                                <div class="form-check form-check-inline">
                                    <label for="top-brands">Deal Exclusive</label>
                                    <input type="checkbox" class="form-check-input" id="top-brands"
                                        name="deal-exclusive" value="1">
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="popular-couponss">Verify</label>
                                    <input type="checkbox" class="form-check-input" id="popular-couponss" name="verify"
                                        value="1">
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-12">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Create coupons</button>
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
