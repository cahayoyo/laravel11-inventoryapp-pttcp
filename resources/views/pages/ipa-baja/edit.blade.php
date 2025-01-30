@extends('layouts.main')

@section('title', 'TCP - Edit IPA Baja')

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
            <span class="text">Edit IPA Baja</span>
        </div>
        <div class="form-container">
            <form action="/ipabajas/{{ $ipaBaja->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">IPA Baja Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter IPA Baja name..." required
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $ipaBaja->name) }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">IPA Baja Image <i>(Optional)</i></label>
                    <input type="file" id="image" name="image"
                        class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    @if ($ipaBaja->image)
                        <div class="mt-2">
                            <small>Current image:</small>
                            <img src="{{ asset('storage/images/' . $ipaBaja->image) }}" alt="{{ $ipaBaja->name }}"
                                style="max-height: 150px; width: auto; display: block;">
                        </div>
                    @endif
                </div>

                <div class="form-actions">
                    <a href="/ipabajas" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
