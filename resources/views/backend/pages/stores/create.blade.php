@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Create New Store</h4>

                    <form action="{{ route('store.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="label-input">Name :</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="label-input" name="name" placeholder="Enter Store Name" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="link-input">Slug :</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        id="link-input" name="slug" placeholder="Enter Store Slug (unique)" required>
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="image-input">Image :</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image-input" name="image" required>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="tagline-input">Store Tagline :</label>
                                    <input type="text" class="form-control @error('tagline') is-invalid @enderror"
                                        id="tagline-input" name="tagline" placeholder="Enter Store Tagline" required>
                                    @error('tagline')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="category-select">Category :</label>
                                    <select name="category_id" id="category-select" class="form-control" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
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

                            <div class="col-lg-12 mb-4">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="top-stores" name="top_stores"
                                        value="1">
                                    <label class="form-check-label" for="top-stores">Top Stores</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="top-brands" name="top_brands"
                                        value="1">
                                    <label class="form-check-label" for="top-brands">Top Brands</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="popular-stores"
                                        name="popular_stores" value="1">
                                    <label class="form-check-label" for="popular-stores">Popular Stores</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="" name="status"
                                        value="1" checked>
                                    <label class="form-check-label" for="status">Status</label>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label>FAQs :</label>
                                    <div id="faqs-container">
                                        <div class="faq-item mb-3">
                                            <input type="text" class="form-control mb-2" name="faqs[0][question]"
                                                placeholder="Question" required>
                                            <textarea class="form-control" name="faqs[0][answer]" placeholder="Answer" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-2" id="add-faq">Add FAQ</button>
                                </div>
                            </div>

                            <h4 class="text-dark mb-4">Store Meta Info</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="meta-title">Meta Title</label>
                                        <input type="text"
                                            class="form-control @error('meta_title') is-invalid @enderror" id="meta-title"
                                            name="meta_title" placeholder="Enter Meta Title" required>
                                        @error('meta_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="meta-keywords">Meta Keywords</label>
                                        <input type="text"
                                            class="form-control @error('meta_keywords[]') is-invalid @enderror"
                                            id="meta-keywords" name="meta_keywords[]" placeholder="Enter Meta Keywords"
                                            required>
                                        @error('meta_keywords[]')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label for="meta-description">Meta Description</label>
                                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta-description"
                                            name="meta_description" rows="3" required>{{ old('meta_description') }}</textarea>
                                        @error('meta_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <h4 class="text-dark mb-4">Chart Info</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="savings-title">Savings</label>
                                        <input type="text"
                                            class="form-control @error('savings') is-invalid @enderror" id="savings-title"
                                            name="savings" placeholder="Enter Saving" required>
                                        @error('savings')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="discount-title">Discounted Price</label>
                                        <input type="text"
                                            class="form-control @error('discount') is-invalid @enderror" id="discount-title"
                                            name="discount" placeholder="Enter Discount" required>
                                        @error('discount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Free shipings --}}
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="free-shipping-title">Free Shipping</label>
                                        {{-- <input type="text"
                                            class="form-control @error('free_shipping') is-invalid @enderror" id="free-shipping-title"
                                            name="free_shipping" placeholder="Enter Free Shipping" required> --}}
                                            <select name="free_shipping">
                                                <option value="Yes" selected="selected">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        @error('free_shipping')
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
                                        <button type="submit" class="btn btn-primary w-md">Create Store</button>
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
            $('#description-textarea').summernote({
                height: 200,
            });

            // // Initialize Select2
            // $('#meta-keywords').select2({
            //     tags: true,
            //     tokenSeparators: [',', ''],
            //     createTag: function(params) {
            //         return {
            //             id: params.term,
            //             text: params.term
            //         };
            //     }
            // });

            // Add FAQ functionality with plain JavaScript
            let faqCount = 1;
            const addFaqButton = document.getElementById('add-faq');
            const faqsContainer = document.getElementById('faqs-container');

            addFaqButton.addEventListener('click', function() {
                const newFaq = document.createElement('div');
                newFaq.className = 'faq-item mb-3';
                newFaq.innerHTML = `
                    <input type="text" class="form-control mb-2" name="faqs[${faqCount}][question]" placeholder="Question no ${faqCount+1}" required>
                    <textarea class="form-control" name="faqs[${faqCount}][answer]" placeholder="Answer no ${faqCount+1}" rows="3" required></textarea>
                `;
                faqsContainer.appendChild(newFaq);
                faqCount++;
            });
        });
    </script>
@endsection
