@extends('layouts.main')

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
            <span class="text">Edit Client</span>
        </div>
        <div class="form-container">
            <form action="/clients/{{ $client->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Client Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter client name..." required
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $client->name) }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter email..." required
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $client->email) }}">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter address..." required
                        class="form-control @error('address') is-invalid @enderror"
                        value="{{ old('address', $client->address) }}">
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter phone number..." required
                        class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $client->phone) }}">
                    @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Client Image <i>(Optional)</i></label>
                    <input type="file" id="image" name="image"
                        class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                @if ($client->image)
                    <div class="form-group">
                        <label for="current">Current image:</label>
                        <img src="{{ asset('storage/images/' . $client->image) }}" alt="{{ $client->name }}"
                            style="max-height: 150px; width: auto; object-fit: contain;">
                    </div>
                @endif

                <div class="form-actions">
                    <a href="/clients" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
