@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Create New Store</h4>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

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
                                    <label for="link-input">Url :</label>
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
                                    <label for="tagline-input">About Store :</label>
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
                                    <label for="category-select">Categories :</label>
                                    <select name="category_ids[]" id="category-select" class="form-select" multiple
                                        required>
                                        @foreach ($combined as $item)
                                            <option value="{{ $item->id }}">
                                                @if ($item->is_subcategory)
                                                    {{ $item->parent_name }} > {{ $item->name }}
                                                @else
                                                    {{ $item->name }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_ids')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="website-input">Website URL:</label>
                                    <input type="url" class="form-control @error('  ') is-invalid @enderror"
                                        id="website-input" name="website" placeholder="Enter Store Website">
                                    @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label for="video-iframe">Video Embed Code (Iframe) :</label>
                                    <textarea class="form-control @error('video') is-invalid @enderror" id="video-iframe" name="video"
                                        placeholder="Paste the iframe embed code for the video here" rows="3">{{ old('video') }}</textarea>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#description-textarea').summernote({
                height: 200,

                // font size
                fontSize: ['8px', '10px', '12px', '14px', '16px', '18px', '20px', '22px', '24px', '26px',
                    '28px', '30px'
                ]

            });

            $(document).ready(function() {
                $('#category-select').select2({
                    placeholder: 'Select categories',
                    allowClear: true,
                    templateResult: formatCategory
                });

                function formatCategory(category) {
                    if (!category.element) {
                        return category.text;
                    }
                    var $category = $(
                        '<span>' + category.text + '</span>'
                    );
                    if ($(category.element).hasClass('main-category')) {
                        $category.css('font-weight', 'bold');
                    }
                    return $category;
                }
            });

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
