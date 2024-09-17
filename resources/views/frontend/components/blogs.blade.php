<section class="section blogs bg-white rounded-3 pb-0">
    <div class="row">
        <!-- Main Blog Post -->
        <div class="col-md-9 mb-4">
            @foreach ($mainBlog as $blog)
                <a href="{{ route('blog-details', ['slug' => $blog->slug]) }}">
                    <img src="{{ asset('uploads/blog/' . $blog->image) }}" alt="Main Blog"
                        class="img-fluid mb-3 rounded-3 w-100">
                    <h2 class="main-blog-title">{{ $blog->name }}</h2>
                    <div class="blog-meta">
                        <span><i class="fas fa-user"></i> Admin</span>
                        <span><i class="far fa-calendar-alt"></i> {{ $blog->created_at->format('d M, Y') }}</span>
                    </div>
                    <p>{{ strip_tags($blog->short_description) }}</p>
                </a>
            @endforeach
        </div>

        <!-- Small Blog Posts -->
        <div class="col-md-3 ps-0">
            <h2 class="widget-title ms-3">Recent Blogs</h2>
            <?php $count = 0; ?>
            @foreach ($blogPosts as $blog)
                <?php if ($count == 2) {
                    break;
                } ?>
                <a href="{{ route('blog-details', ['slug' => $blog->slug]) }}">
                    <div class="small-blog">
                        <div class="small-blog-content">
                            <img src="{{ asset('uploads/blog/' . $blog->image) }}" alt="Main Blog"
                                class="w-100 img-fluid mb-3 rounded-3">
                            <h3 class="small-blog-title">{{ $blog->name }}</h3>
                            <p>{{ Str::limit(strip_tags($blog->short_description), 70) }}</p>
                            <small>{{ $blog->created_at->format('d M, Y') }}</small>
                        </div>
                    </div>
                </a>
                <?php $count++; ?>
            @endforeach
        </div>
    </div>
</section>
</div>
