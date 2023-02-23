@extends('front-page.layout')

@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col">
                <div class="card overflow-hidden">
                    @if ($post->image)
                        <img class="card-img-top" style="height: 270px; width: auto;" src="{{ Storage::disk('public')->url($post->image) }}" alt="post-image">
                    @else
                        <img class="card-img-top img-fluid" src="https://picsum.photos/1200/900" alt="post-image">
                    @endif
                    <div class="card-body">
                        <div class="h-100 d-flex flex-column justify-content-between">
                            <div class="post-content">
                                <h1 class="mb-3">{{ $post->title }}</h1>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="text-dark">
                                            <span class="fa fa-user mr-2"></span>
                                            {{ $post->created_by }}
                                        </div>
                                        <div class="text-secondary">
                                            <span class="fa fa-clock mr-2"></span>
                                            {{ $post->created_at->format('d F Y') }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-end">
                                            @foreach ($post->categories as $category)
                                                <a href="#" class="badge badge-secondary mx-1">{{ $category->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <p>{!! $post->content !!}</p>
                                <div class="mt-5">
                                    @foreach ($post->categories as $category)
                                        <a href="#" class="btn btn-outline-secondary mx-1 my-3">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
