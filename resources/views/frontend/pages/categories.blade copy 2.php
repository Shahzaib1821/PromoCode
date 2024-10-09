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
                                <button class="category-nav-link nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="{{ $category->slug }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#{{ $category->slug }}" type="button" role="tab"
                                    aria-controls="{{ $category->slug }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                    {{ $category->name }}
                                </button>
                                @if ($category->subcategories->isNotEmpty())
                                    <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#subcategory-{{ $category->id }}" aria-expanded="false"
                                        aria-controls="subcategory-{{ $category->id }}">
                                        Subcategories
                                    </button>
                                    <div class="collapse" id="subcategory-{{ $category->id }}">
                                        <ul class="subcategory-list ps-3 mt-2">
                                            @foreach ($category->subcategories as $subcategory)
                                                <li class="subcategory-item">
                                                    <button class="category-nav-link nav-link {{ $loop->first ? 'active' : '' }}"
                                                        id="{{ $subcategory->slug }}-tab" data-bs-toggle="tab"
                                                        data-bs-target="#{{ $subcategory->slug }}" type="button" role="tab"
                                                        aria-controls="{{ $subcategory->slug }}"
                                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                        {{ $subcategory->name }}
                                                    </button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9 sidebar">
                <div class="tab-content" id="storeTabsContent">
                    @foreach ($categories as $category)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $category->slug ?? $subcategory->slug  }}"
                            role="tabpanel" aria-labelledby="{{ $category->slug ?? $subcategory->slug }}-tab">
                            <h3 class="mb-4">{{ $category->name ?? $subcategory->name }} Stores</h3>
                            <div class="row" id="{{ $category->slug ?? $subcategory->slug}}-stores">
                                @foreach ($category->allStores as $store)
                                    <div class="col-lg-3 col-md-4 col-sm-6 store-item"
                                        data-subcategory="{{ $store->subcategory_id }}">
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
                    @foreach ($subcategory as $category)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{$subcategory->slug  }}"
                            role="tabpanel" aria-labelledby="{{$subcategory->slug }}-tab">
                            <h3 class="mb-4">{{ $category->name ?? $subcategory->name }} Stores</h3>
                            <div class="row" id="{{$subcategory->slug}}-stores">
                                @foreach ($subcategory->stores as $store)
                                    <div class="col-lg-3 col-md-4 col-sm-6 store-item"
                                        data-subcategory="{{ $store->subcategory_id }}">
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle tab switching
        document.querySelectorAll('.category-nav-link').forEach(tab => {
            tab.addEventListener('click', function() {
                const targetId = this.getAttribute('data-bs-target').slice(1);
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.remove('show', 'active');
                });
                document.getElementById(targetId).classList.add('show', 'active');
            });
        });

        // Subcategory filtering
        document.querySelectorAll('.subcategory-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const category = this.dataset.category;
                const subcategoryId = this.dataset.subcategory;

                // Show all stores for the category
                document.querySelectorAll(`#${category}-stores .store-item`).forEach(item => {
                    item.style.display = 'block';
                });

                // Hide stores that don't match the subcategory
                if (subcategoryId) {
                    document.querySelectorAll(`#${category}-stores .store-item:not([data-subcategory="${subcategoryId}"])`).forEach(item => {
                        item.style.display = 'none';
                    });
                }
            });
        });
    });
</script>
@endsection
