@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Edit User') }}</h4>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('user.update', $user->id) }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >
                            @method('put')
                            @csrf
                            {{-- Name --}}
                            <div class="row mb-3">
                                <label
                                    for="name"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input
                                        id="name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        value="{{ old('name', $user->name) }}"
                                    >

                                    @error('name')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Tanggal Lahir --}}
                            <div class="row mb-3">
                                <label
                                    for="date_of_birth"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Tanggal Lahir') }}</label>

                                <div class="col-md-6">
                                    <input
                                        id="date_of_birth"
                                        type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth"
                                        value="{{ old('date_of_birth', $user->date_of_birth) }}"
                                    >

                                    @error('date_of_birth')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Jenis Kelamin --}}
                            <div class="row mb-3">
                                <label
                                    for="gender"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Jenis Kelamin') }}</label>

                                <div class="col-md-6">
                                    <select
                                        class="form-control @error('gender') is-invalid @enderror"
                                        aria-label="Default select example"
                                        name="gender"
                                    >
                                        <option
                                            {{ old('gender', $user->gender) === "Laki-Laki" ? 'selected' : '' }}
                                            value="Laki-Laki"
                                        >Laki-Laki</option>
                                        <option
                                            {{ old('gender', $user->gender) === "Perempuan" ? 'selected' : '' }}
                                            value="Perempuan"
                                        >Perempuan</option>
                                    </select>

                                    @error('gender')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Alamat --}}
                            <div class="row mb-3">
                                <label
                                    for="address"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Alamat') }}</label>

                                <div class="col-md-6">
                                    <textarea
                                        id="address"
                                        type="text"
                                        class="form-control @error('address') is-invalid @enderror"
                                        name="address"
                                    >{{ old('address', $user->address) }}</textarea>

                                    @error('address')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Status --}}
                            <div class="row mb-3">
                                <label
                                    for="gender"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Status') }}</label>

                                <div class="col-md-6">
                                    <select
                                        class="form-control @error('status') is-invalid @enderror"
                                        aria-label="Default select example"
                                        name="status"
                                    >
                                        <option
                                            {{ old('status', $user->status) === "active" ? 'selected' : '' }}
                                            value="active"
                                        >Active</option>
                                        <option
                                            {{ old('status', $user->status) === "blocked" ? 'selected' : '' }}
                                            value="blocked"
                                        >Blocked</option>
                                    </select>

                                    @error('status')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- images --}}
                            <div class="row mb-3">
                                <label
                                    for="images"
                                    class="col-md-4 col-form-label text-md-end"
                                >{{ __('Foto') }}</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div>
                                            @if ($user->photo)
                                                <img src="{{ Storage::url($user->photo) }}" class="img-fluid mb-3 rounded">
                                            @endif
                                            <input
                                                name="images"
                                                class="form-control @error('images') is-invalid @enderror"
                                                value="{{ old('images', $user->images) }}"
                                                type="file"
                                                accept="image/*"
                                                id="formFile"
                                            >
                                            <small
                                                for="formFile"
                                                class="form-label"
                                            >Silahkan Upload Foto Anda</small>
                                        </div>
                                    </div>
                                    @error('images')
                                        <span
                                            class="invalid-feedback"
                                            role="alert"
                                        >
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Save --}}
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button
                                        type="submit"
                                        class="btn btn-dark"
                                    >
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
