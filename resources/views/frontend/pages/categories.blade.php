@extends('frontend.layouts.app')

@section('content')
    <div class="container my-4">
        <h2 class="mb-5">Browse Stores by Category</h2>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="category-sidebar position-sticky" style="top: 30px;">
                    <ul class="nav flex-column ps-3 align-items-start gap-2 sidebar" id="storeTabs" role="tablist">
                        <h4 class="mb-4">Categories</h4>
                        @foreach ($categories as $category)
                            <li class="category-nav-item" role="presentation">
                                <button
                                    class="category-nav-link nav-link {{ $category->slug === $activeCategory ? 'active' : '' }}"
                                    id="{{ $category->slug }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#{{ $category->slug }}" type="button" role="tab"
                                    aria-controls="{{ $category->slug }}"
                                    aria-selected="{{ $category->slug === $activeCategory ? 'true' : 'false' }}">
                                    {{ $category->name }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9 sidebar">
                <div class="tab-content" id="storeTabsContent">
                    @foreach ($categories as $category)
                        <div class="tab-pane fade {{ $category->slug === $activeCategory ? 'show active' : '' }}"
                            id="{{ $category->slug }}" role="tabpanel" aria-labelledby="{{ $category->slug }}-tab">
                            <h3 class="mb-4">{{ $category->name }} Stores</h3>
                            <div class="row">
                                @forelse ($stores->where('category_id', $category->id) as $store)
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <a href="{{ route('stores-details', ['slug' => $store->slug]) }}">
                                            <div class="card p-0 card-horizontal">
                                                <img src="{{ asset('uploads/stores/' . $store->image) }}"
                                                    alt="{{ $store->name }}" class="card-img-top">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $store->name }}</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                    <p class="text-center">No stores found in this category.</p>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const activeCategory = urlParams.get('active');
            if (activeCategory) {
                const tab = document.querySelector(`#${activeCategory}-tab`);
                if (tab) {
                    tab.click();
                }
            } else {
                // Ensure the first tab is activated by default if no activeCategory is set
                const firstTab = document.querySelector('.category-nav-link');
                if (firstTab) {
                    firstTab.click();
                }
            }
        });
    </script>
@endsection
