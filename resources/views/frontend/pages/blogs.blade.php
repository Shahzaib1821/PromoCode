@extends('frontend.layouts.app')

@section('content')
    <header class="hero text-center">
        <div class="container">
            <h1>Our Blog</h1>
            <p class="lead">Discover the latest trends, tips, and insights about coupons and savings.</p>
        </div>
    </header>

    <div class="blog-page-area pd-top-120 wrapper">
        <div class="container">
            <div class="row custom-gutters-60">
                <div class="col-lg-8">
                    @if (isset($query))
                        <h2>Search Results for: {{ $query }}</h2>
                    @endif
                    <div class="row">
                        @forelse ($blogs as $post)
                            <div class="col-lg-6">
                                <a href="{{ route('blog-details', ['slug' => $post->slug]) }}">
                                    <div class="single-blog-content">
                                        <div class="thumb">
                                            <img src="{{ asset('uploads/blog/' . $post->image) }}" alt="blog">
                                        </div>
                                        <div class="single-blog-details">
                                            <ul class="post-meta">
                                                <li class="admin"><i class="fas fa-user me-3"></i> Admin</li>
                                                <li><i class="far fa-calendar-alt"></i>
                                                    {{ $post->created_at->format('F d, Y') }}</li>
                                            </ul>
                                            <h5>{{ Str::limit(strip_tags($post->name), 45) }}</h5>
                                            <p>{{ Str::limit(strip_tags($post->short_description), 280) }}</p>
                                            <span>Read More <i class="la la-long-arrow-right"></i></span>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        @empty
                            <div class="col-12">
                                <p>No blog posts found.</p>
                            </div>
                        @endforelse
                    </div>
                    <div class="col-12">
                        <div class="riyaqas-pagination mg-top-45 position-relative">
                            {{ $blogs->appends(request()->query())->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar-area">
                        <div class="widget widget_search">
                            <form class="search-form" action="{{ route('blogs.search') }}" method="GET">
                                <div class="form-group">
                                    <input type="text" name="query" placeholder="Search"
                                        value="{{ request('query') }}">
                                </div>
                                <button class="submit-btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget widget_categories">
                            <h2 class="widget-title">Category</h2>
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a
                                            href="{{ route('blogs', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget_archive">
                            <h2 class="widget-title">Archives</h2>
                            <ul>
                                @foreach ($archives as $archive)
                                    <li>
                                        <a
                                            href="{{ route('blogs', ['archive' => Carbon\Carbon::parse($archive)->format('Y-m')]) }}">
                                            {{ $archive }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Other sidebar widgets... -->
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
