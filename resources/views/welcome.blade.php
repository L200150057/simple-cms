<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset('vendor/admin-lte/adminlte.min.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
        </div>
    </nav>
    <div class="container">
        <div class="row my-4">
            <div class="col">
                <div id="pinned-post-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($pinnedPosts->where('is_pinned', true) as $post)
                            <li data-target="#pinned-post-carousel" data-slide-to="0" class="{{ $loop->first ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach ($pinnedPosts->where('is_pinned', true) as $index => $post)
                            <div style="height: 400px;" class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                @if ($post->image)
                                    <img src="{{ Storage::disk('public')->url($post->image) }}" class="d-block" alt="pinned-post-image" style="object-fit: cover;">
                                @else
                                    <img src="https://picsum.photos/1200/900" class="d-block" alt="pinned-post-image" style="object-fit: cover;">
                                @endif
                                <div class="carousel-caption d-none d-md-block" style="cursor: pointer;">
                                    <h5>{{ $post->title }}</h5>
                                    <p>{!! $post->content_summary !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#pinned-post-carousel" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#pinned-post-carousel" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-4">
                    <div class="card overflow-hidden" style="height: 600px">
                        @if ($post->image)
                            <img class="card-img-top" style="height: 270px; width: auto;" src="{{ Storage::disk('public')->url($post->image) }}" alt="post-image">
                        @else
                            <img class="card-img-top img-fluid" src="https://picsum.photos/1200/900" alt="post-image">
                        @endif
                        <div class="card-body">
                            <div class="h-100 d-flex flex-column justify-content-between">
                                <div class="post-content">
                                    <small class="text-secondary">{{ $post->created_at->format('d F Y') }}</small>
                                    <h4>{{ $post->title }}</h4>
                                    <p>{!! $post->content_summary !!}</p>
                                </div>
                                <a class="btn btn-primary" href="{{ route('front.page.show', $post->slug) }}">Read more...</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>Post not found.</p>
            @endforelse
        </div>
        <div class="d-flex justify-content-center my-4    ">
            {{ $posts->links() }}
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/admin-lte/adminlte.min.js') }}"></script>
</body>

</html>
