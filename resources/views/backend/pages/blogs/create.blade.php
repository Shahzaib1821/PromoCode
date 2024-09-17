@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ isset($blogs) ? 'Edit' : 'Create' }} Blog Post</h4>

                    <form action="{{ isset($blogs) ? route('blogs.update', $blogs) : route('blogs.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($blogs))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="name">Name :</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ $blogs->name ?? old('name') }}"
                                        placeholder="Enter blog post name" required>
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
                                    <select class="form-select @error('status') is-invalid @enderror" name="status"
                                        required>
                                        <option value="" disabled>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label for="short_description">Short Description :</label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                                        name="short_description" rows="3" placeholder="Enter short description" required>{{ $blogs->short_description ?? old('short_description') }}</textarea>
                                    @error('short_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label for="long_description">Long Description :</label>
                                    <textarea class="form-control @error('long_description') is-invalid @enderror" id="long_description"
                                        name="long_description" rows="5" placeholder="Enter long description" required>{{ $blogs->long_description ?? old('long_description') }}</textarea>
                                    @error('long_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="category_id">Category :</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                                        name="category_id" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ isset($blogs) && $blogs->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
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
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-check mb-4">
                                    <input type="checkbox" class="form-check-input" id="popular_blog" name="popular_blog"
                                        value="1" {{ isset($blogs) && $blogs->popular_blog ? 'checked' : '' }}>
                                    <label class="form-check-label" for="popular_blog">Popular Blog</label>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-check mb-4">
                                    <input type="checkbox" class="form-check-input" id="top_blog" name="top_blog"
                                        value="1" {{ isset($blogs) && $blogs->top_blog ? 'checked' : '' }}>
                                    <label class="form-check-label" for="top_blog">Top Blog</label>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-check mb-4">
                                    <input type="checkbox" class="form-check-input" id="featured_blog" name="featured_blog"
                                        value="1" {{ isset($blogs) && $blogs->featured_blog ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured_blog">Featured Blog</label>
                                </div>
                            </div>

                            <h4 class="text-dark mb-4">Blog FAQ's</h4>

                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label for="faqs">FAQs :</label>
                                    <div id="faqs-container">
                                        @if (isset($blogs) && $blogs->faqs)
                                            @foreach ($blogs->faqs as $index => $faq)
                                                <div class="faq-item">
                                                    <input type="text" class="form-control mb-2"
                                                        name="faqs[{{ $index }}][question]"
                                                        value="{{ $faq['question'] }}" placeholder="Question">
                                                    <textarea class="form-control mb-2" name="faqs[{{ $index }}][answer]" placeholder="Answer">{{ $faq['answer'] }}</textarea>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="faq-item">
                                                <input type="text" class="form-control mb-2" name="faqs[0][question]"
                                                    placeholder="Question">
                                                <textarea class="form-control mb-2" name="faqs[0][answer]" placeholder="Answer"></textarea>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-secondary" id="add-faq">Add FAQ</button>
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

                            <div class="col-lg-12 text-end">
                                <button type="submit"
                                    class="btn btn-primary">{{ isset($blogs) ? 'Update' : 'Create' }}</button>
                                <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Cancel</a>
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
            $('#long_description').summernote({
                height: 200,
            });
            $('#short_description').summernote({
                height: 200,
            });

            document.getElementById('add-faq').addEventListener('click', function() {
                const container = document.getElementById('faqs-container');
                const index = container.children.length;
                const newFaq = document.createElement('div');
                newFaq.className = 'faq-item';
                newFaq.innerHTML = `
            <input type="text" class="form-control mb-2" name="faqs[${index}][question]" placeholder="Question">
            <textarea class="form-control mb-2" name="faqs[${index}][answer]" placeholder="Answer"></textarea>
        `;
                container.appendChild(newFaq);
            });
        });
    </script>
@endsection
