@extends('layouts.main')

@section('title', 'TCP - Create Category')

@section('content')
    @if ($errors->all())
        <script>
            Swal.fire({
                title: "Error Occured",
                text: "@foreach ($errors->all() as $error) {{ $error }} @endforeach",
                icon: "error"
            });
        </script>
    @endif

    <div class="overview">
        <div class="title">
            <i class="uil uil-grids"></i>
            <span class="text">Create Category</span>
        </div>
        <div class="form-container">
            <form action="/categories/store" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter category name..." required
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-actions">
                    <a href="/categories" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
