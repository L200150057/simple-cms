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
            <div class="row">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                        <a class="nav-link" href="#">Features</a>
                        <a class="nav-link" href="#">Pricing</a>
                        <a class="nav-link disabled">Disabled</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row my-4">
            <div class="col">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div style="height: 400px;" class="carousel-item active">
                            <img src="https://picsum.photos/1366/768" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block" style="cursor: pointer;">
                                <h5>First slide label</h5>
                                <p>Some representative placeholder content for the first slide.</p>
                            </div>
                        </div>
                        <div style="height: 400px;" class="carousel-item">
                            <img src="https://picsum.photos/1366/768" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block" style="cursor: pointer;">
                                <h5>Second slide label</h5>
                                <p>Some representative placeholder content for the second slide.</p>
                            </div>
                        </div>
                        <div style="height: 400px;" class="carousel-item">
                            <img src="https://picsum.photos/1366/768" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block" style="cursor: pointer;">
                                <h5>Third slide label</h5>
                                <p>Some representative placeholder content for the third slide.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
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
