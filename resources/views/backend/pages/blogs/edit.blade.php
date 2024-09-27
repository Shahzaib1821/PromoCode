@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">{{ isset($blog) ? 'Edit' : 'Create' }} Blog Post</h4>

                    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($blog))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="name">Name :</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ $blog->name ?? old('name') }}"
                                        placeholder="Enter blog post name" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- status --}}
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="status">Status :</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status"
                                        required>
                                        <option value="1" {{ old('status', $blog->status) == 1 ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="0" {{ old('status', $blog->status) == 0 ? 'selected' : '' }}>
                                            Inactive</option>
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
                                        name="short_description" rows="3" placeholder="Enter short description" required>{{ $blog->short_description ?? old('short_description') }}</textarea>
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
                                        name="long_description" rows="5" placeholder="Enter long description" required>{{ $blog->long_description ?? old('long_description') }}</textarea>
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
                                                {{ isset($blog) && $blog->category_id == $category->id ? 'selected' : '' }}>
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
                                    @if (isset($blog) && $blog->image)
                                        <img src="{{ asset('uploads/blog/' . $blog->image) }}" alt="Current Image"
                                            class="img-thumbnail mt-2" width="150">
                                    @endif
                                </div>
                            </div>

                            {{-- popular blog select --}}
                            <div class="col-lg-6">
                                <label for="popular_blog">Popular Blog :</label>
                                <select class="form-select @error('popular_blog') is-invalid @enderror" name="popular_blog"
                                    required>
                                    <option value="1"
                                        {{ old('popular_blog', $blog->popular_blog) == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0"
                                        {{ old('popular_blog', $blog->popular_blog) == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('popular_blog')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- top blog select --}}
                            <div class="col-lg-6">
                                <label for="top_blog">Top Blogs</label>
                                <select class="form-select @error('top_blog') is-invalid @enderror" name="top_blog"
                                    required>
                                    <option value="1" {{ old('top_blog', $blog->top_blog) == 1 ? 'selected' : '' }}>
                                        Yes</option>
                                    <option value="0" {{ old('top_blog', $blog->top_blog) == 0 ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('top_blog')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                             {{-- featured blog select --}}
                             <div class="col-lg-6">
                                <label for="featured_blog">Featured Blog</label>
                                <select class="form-select @error('featured_blog') is-invalid @enderror" name="featured_blog"
                                    required>
                                    <option value="1" {{ old('featured_blog', $blog->featured_blog) == 1 ? 'selected' : '' }}>
                                        Yes</option>
                                    <option value="0" {{ old('featured_blog', $blog->featured_blog) == 0 ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('featured_blog')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <h4 class="text-dark mb-4">Blog FAQ's</h4>

                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label>FAQs :</label>
                                    <div id="faqs-container">
                                        @php
                                            $faqs = is_string($blog->faqs)
                                                ? json_decode($blog->faqs, true)
                                                : $blog->faqs;
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

                            <h4 class="text-dark mb-4">Blog Meta Info</h4>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label for="meta_title">Meta Title :</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                        id="meta_title" name="meta_title"
                                        value="{{ $blog->meta_title ?? old('meta_title') }}"
                                        placeholder="Enter meta title" required>
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
                                        $meta_keywords = is_string($blog->meta_keywords)
                                            ? json_decode($blog->meta_keywords, true)
                                            : $blog->meta_keywords;
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
                                    <label for="meta_description">Meta Description :</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                        name="meta_description" rows="3" placeholder="Enter meta description" required>{{ $blog->meta_description ?? old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 text-end">
                                <button type="submit"
                                    class="btn btn-primary">{{ isset($blog) ? 'Update' : 'Create' }}</button>
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
