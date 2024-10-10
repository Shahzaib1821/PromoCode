@extends('frontend.layouts.app')

@section('content')
    <div class="container my-4">
        <h2 class="mb-5">Browse Stores by Category</h2>
        <div class="row">
            <!-- Sidebar for Categories and Subcategories -->
            <div class="col-md-3 mb-4">
                <div class="category-sidebar position-sticky" style="top: 30px;">
                    <ul class="nav flex-column ps-3 align-items-start gap-2 sidebar" id="storeTabs" role="tablist">
                        <h4 class="mb-4">Categories</h4>
                        @foreach ($categories as $category)
                            <li class="category-nav-item" role="presentation">

                                <!-- Subcategories if they exist -->
                                @if ($category->subcategories->isNotEmpty())
                                    <!-- Main Category Button -->
                                    <button
                                        class="category-nav-link nav-link {{ $category->slug == $activeCategorySlug ? 'active' : '' }}"
                                        id="{{ $category->slug }}-tab" data-bs-toggle="tab"
                                        data-bs-target="#{{ $category->slug }}" type="button" role="tab"
                                        aria-controls="{{ $category->slug }}"
                                        aria-selected="{{ $category->slug == $activeCategorySlug ? 'true' : 'false' }}">
                                        {{ $category->name }}

                                        <a class="btn btn-link dropdown-toggle ps-0 py-0" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#subcategory-{{ $category->id }}" aria-expanded="false"
                                            aria-controls="subcategory-{{ $category->id }}">

                                        </a>
                                    </button>
                                    <div class="collapse" id="subcategory-{{ $category->id }}">
                                        <ul class="subcategory-list ps-3 mt-2">
                                            @foreach ($category->subcategories as $subcategory)
                                                <li class="subcategory-item">
                                                    <button class="category-nav-link nav-link"
                                                        id="{{ $subcategory->slug }}-tab" data-bs-toggle="tab"
                                                        data-bs-target="#{{ $subcategory->slug }}" type="button"
                                                        role="tab" aria-controls="{{ $subcategory->slug }}">
                                                        {{ $subcategory->name }}
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @elseif ($category->subcategories->isEmpty())
                                    <button
                                        class="category-nav-link nav-link {{ $category->slug == $activeCategorySlug ? 'active' : '' }}"
                                        id="{{ $category->slug }}-tab" data-bs-toggle="tab"
                                        data-bs-target="#{{ $category->slug }}" type="button" role="tab"
                                        aria-controls="{{ $category->slug }}"
                                        aria-selected="{{ $category->slug == $activeCategorySlug ? 'true' : 'false' }}">
                                        {{ $category->name }}
                                    </button>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Main content area where stores are displayed -->
            <div class="col-md-9 sidebar">
                <div class="tab-content" id="storeTabsContent">
                    @foreach ($categories as $category)
                        <!-- Main Category Tab Content -->
                        <div class="tab-pane fade {{ $category->slug == $activeCategorySlug ? 'show active' : '' }}"
                            id="{{ $category->slug }}" role="tabpanel" aria-labelledby="{{ $category->slug }}-tab">
                            <h3 class="mb-4">{{ $category->name }} Stores</h3>
                            <div class="row" id="{{ $category->slug }}-stores">
                                <!-- Show only stores for this main category -->
                                @foreach ($category->stores as $store)
                                    <div class="col-lg-3 col-md-4 col-sm-6 store-item">
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
                                @endforeach
                            </div>
                        </div>

                        <!-- Subcategory Tab Content -->
                        @foreach ($category->subcategories as $subcategory)
                            <div class="tab-pane fade" id="{{ $subcategory->slug }}" role="tabpanel"
                                aria-labelledby="{{ $subcategory->slug }}-tab">
                                <h3 class="mb-4">{{ $subcategory->name }} Stores</h3>
                                <div class="row" id="{{ $subcategory->slug }}-stores">
                                    <!-- Show only stores for this subcategory -->
                                    @foreach ($subcategory->stores as $store)
                                        <div class="col-lg-3 col-md-4 col-sm-6 store-item">
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
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle tab switching
            document.querySelectorAll('.category-nav-link, .subcategory-nav-link').forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-bs-target').slice(1);
                    document.querySelectorAll('.tab-pane').forEach(pane => {
                        pane.classList.remove('show', 'active');
                    });
                    document.getElementById(targetId).classList.add('show', 'active');
                });
            });
        });
    </script>
@endsection
