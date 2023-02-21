@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}">
@endpush

@section('content')
    <div class="container">
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Create Post') }}</h4>
                        </div>
                        <div class="card-body">
                            {{-- Title --}}
                            <div class="form-group mb-3">
                                <label for="title">{{ __('Title') }}</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- Content --}}
                            <div class="form-group mb-3">
                                <label for="content">{{ __('Content') }}</label>
                                <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" rows="8">{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            {{-- Image --}}
                            <div class="form-group mb-3">
                                <label for="image">{{ __('Image') }}</label>
                                <input id="image" type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Tags</label>
                                <div style="height: 100px; overflow: auto;">
                                    @foreach ($tags as $tag)
                                        <div class="form-check ml-2">
                                            <input
                                                class="form-check-input"
                                                name="tags[]"
                                                type="checkbox"
                                                id="tag_{{ $tag->id }}"
                                                value="{{ $tag->id }}"
                                                {{
                                                    in_array($tag->id, old('tags', []))
                                                        ? "checked"
                                                        : ""
                                                }}
                                            >
                                            <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Categories</label>
                                <div style="height: 100px; overflow: auto;">
                                    @foreach ($categories as $category)
                                        <div class="form-check ml-2">
                                            <input
                                                class="form-check-input"
                                                name="categories[]"
                                                type="checkbox"
                                                id="category_{{ $category->id }}"
                                                value="{{ $category->id }}"
                                                {{
                                                    in_array($category->id, old('categories', []))
                                                        ? "checked"
                                                        : ""
                                                }}
                                            >
                                            <label class="form-check-label" for="category_{{ $category->id }}">{{ $category->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-block btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            $("#content").summernote({
                height: 500
            });
        })
    </script>
@endpush
