@extends('frontend.layouts.app')

@section('content')
    <header class="hero text-center">
        <div class="container">
            <h1>Blog Details</h1>
            <p class="lead">Discover the latest trends, tips, and insights about coupons and savings.</p>
        </div>
    </header>

    <div class="blog-details-page pd-top-120 wrapper">
        <div class="container">
            <div class="row custom-gutters-60">
                <div class="col-lg-8">
                    <div class="single-blog-content">
                        <div class="thumb">
                            <img src="{{ asset('uploads/blog/' . $blog->image) }}" alt="blog">
                        </div>
                        <div class="single-blog-details">
                            <ul class="post-meta d-flex justify-content-between">
                                <li class="admin"><i class="fas fa-user me-3"></i> Admin</li>
                                <li><i class="far fa-calendar-alt"></i> <b>Published at: </b>
                                    {{ $blog->created_at->format('F d, Y') }}</li>
                            </ul>
                            <h5>{{ $blog->name }}</h5>
                            <p>{!! $blog->short_description !!}</p>
                            <p>{!! $blog->long_description !!}</p>
                        </div>
                    </div>
                    <div class="row post-share-area">
                        <div class="col-xl-6 mb-3 mb-xl-0">
                            <h2 class="mb-3 sb-inner-title d-sm-inline-block">Share the Post : </h2>
                            <ul class="social-icon d-sm-inline-block">
                                <li>
                                    <a class="facebook" href="#" target="_blank"><i
                                            class="fa-brands fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a class="twitter" href="#" target="_blank"><i
                                            class="fa-brands fa-x-twitter"></i></a>
                                </li>
                                <li>
                                    <a class="linkedin" href="#" target="_blank"><i
                                            class="fa-brands fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a class="pinterest" href="#" target="_blank"><i
                                            class="fa-brands fa-linkedin-in"></i></a>
                                </li>
                            </ul>
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
                        @if ($popularBlogs->count() > 0)
                            <div class="widget widget-recent-post">
                                <h2 class="widget-title">Popular Posts</h2>
                                <ul>
                                    @foreach ($popularBlogs as $blog)
                                        <li>
                                            <a href="{{ route('blog-details', ['slug' => $blog->slug]) }}">
                                            <div class="media">
                                                    <img src="{{ asset('uploads/blog/' . $blog->image) }}" alt="widget">
                                                    <div class="media-body">
                                                        <h6 class="title">
                                                            {{ $blog->name }}
                                                        </h6>
                                                        <span
                                                            class="post-date">{{ $blog->created_at->format('F d, Y') }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
