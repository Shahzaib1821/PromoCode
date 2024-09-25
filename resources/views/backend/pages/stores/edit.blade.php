@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Store</h4>

                    <form action="{{ route('store.update', $store->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="label-input">Name :</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="label-input" name="name" placeholder="Enter Store Name" required
                                        value="{{ old('name', $store->name) }}">
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
                                        id="link-input" name="slug" placeholder="Enter Store Slug (unique)" required
                                        value="{{ old('slug', $store->slug) }}">
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
                                        id="image-input" name="image">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if ($store->image)
                                        <img src="{{ asset('uploads/stores/' . $store->image) }}" alt="Current Image"
                                            class="mt-2" style="max-width: 200px;">
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="tagline-input">Store Tagline :</label>
                                    <input type="text" class="form-control @error('tagline') is-invalid @enderror"
                                        id="tagline-input" name="tagline" placeholder="Enter Store Tagline" required
                                        value="{{ old('tagline', $store->tagline) }}">
                                    @error('tagline')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="subcategory-select">Subcategory :</label>
                                    <select name="subcategory_id" id="subcategory-select" class="form-select" required>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}"
                                                {{ old('subcategory_id', $store->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                                {{ $subcategory->category->name }} > {{ $subcategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- Website Input Field for Edit Page -->
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="website">Website URL :</label>
                                    <input type="url" class="form-control @error('website') is-invalid @enderror"
                                        id="website" name="website" value="{{ old('website', $store->website) }}"
                                        placeholder="Enter Store Website URL" required>
                                    @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Video Iframe Input Field for Edit Page -->
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label for="video-iframe">Video Embed Code (Iframe) :</label>
                                    <textarea class="form-control @error('video') is-invalid @enderror" id="video-iframe" name="video"
                                        placeholder="Paste the iframe embed code for the video here" rows="3">{{ old('video', $store->video) }}</textarea>
                                    @error('video')
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
                                        rows="5" required>{{ old('description', $store->description) }}</textarea>
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
                                        value="1" {{ $store->top_stores ? 'checked' : '' }}>
                                    <label class="form-check-label" for="top-stores">Top Stores</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="top-brands" name="top_brands"
                                        value="1" {{ $store->top_brands ? 'checked' : '' }}>
                                    <label class="form-check-label" for="top-brands">Top Brands</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" id="popular-stores"
                                        name="popular_stores" value="1"
                                        {{ $store->popular_stores ? 'checked' : '' }}>
                                    <label class="form-check-label" for="popular-stores">Popular Stores</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="status" value="1"
                                        {{ $store->status ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">Status</label>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label>FAQs :</label>
                                    <div id="faqs-container">
                                        @php
                                            $faqs = is_string($store->faqs)
                                                ? json_decode($store->faqs, true)
                                                : $store->faqs;
                                            $faqs = is_array($faqs) ? $faqs : [];
                                        @endphp
                                        @foreach ($faqs as $index => $faq)
                                            <div class="faq-item mb-3">
                                                <input type="text" class="form-control mb-2"
                                                    name="faqs[{{ $index }}][question]" placeholder="Question"
                                                    required value="{{ $faq['question'] ?? '' }}">
                                                <textarea class="form-control" name="faqs[{{ $index }}][answer]" placeholder="Answer" rows="3"
                                                    required>{{ $faq['answer'] ?? '' }}</textarea>
                                            </div>
                                        @endforeach
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
                                            name="meta_title" placeholder="Enter Meta Title" required
                                            value="{{ old('meta_title', $store->meta_title) }}">
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
                                        @php
                                            // Decode the JSON if it's a string, otherwise, keep it as an array
                                            $meta_keywords = is_string($store->meta_keywords)
                                                ? json_decode($store->meta_keywords, true)
                                                : $store->meta_keywords;
                                            $meta_keywords = is_array($meta_keywords) ? $meta_keywords : [];
                                        @endphp
                                        <input type="text"
                                            class="form-control @error('meta_keywords') is-invalid @enderror"
                                            id="meta-keywords" name="meta_keywords" placeholder="Enter Meta Keywords"
                                            required value="{{ old('meta_keywords', implode(',', $meta_keywords)) }}">
                                        @error('meta_keywords')
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
                                            name="meta_description" rows="3" required>{{ old('meta_description', $store->meta_description) }}</textarea>
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
                                        <input type="text" class="form-control @error('savings') is-invalid @enderror"
                                            id="savings-title" name="savings" placeholder="Enter Saving" required
                                            value="{{ old('savings', $store->savings) }}">
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
                                            class="form-control @error('discount') is-invalid @enderror"
                                            id="discount-title" name="discount" placeholder="Enter Discount" required
                                            value="{{ old('discount', $store->discount) }}">
                                        @error('discount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="free-shipping-title">Free Shipping</label>
                                        <select name="free_shipping" class="form-select">
                                            <option value="Yes"
                                                {{ old('free_shipping', $store->free_shipping) == 'Yes' ? 'selected' : '' }}>
                                                Yes</option>
                                            <option value="No"
                                                {{ old('free_shipping', $store->free_shipping) == 'No' ? 'selected' : '' }}>
                                                No</option>
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
                                        <button type="submit" class="btn btn-primary w-md">Update Store</button>
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
                fontFamily: 'Poppins',
            });

            // Add FAQ functionality with plain JavaScript
            let faqCount = 0; // Start from 0
            const addFaqButton = document.getElementById('add-faq');
            const faqsContainer = document.getElementById('faqs-container');

            // Count existing FAQs
            faqCount = faqsContainer.querySelectorAll('.faq-item').length;

            addFaqButton.addEventListener('click', function() {
                const newFaq = document.createElement('div');
                newFaq.className = 'faq-item mb-3';
                newFaq.innerHTML = `
                    <input type="text" class="form-control mb-2" name="faqs[${faqCount}][question]" placeholder="Question ${faqCount + 1}" required>
                    <textarea class="form-control" name="faqs[${faqCount}][answer]" placeholder="Answer ${faqCount + 1}" rows="3" required></textarea>
                `;
                faqsContainer.appendChild(newFaq);
                faqCount++;
            });
        });
    </script>
@endsection
