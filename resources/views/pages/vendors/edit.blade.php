@extends('layouts.main')

@section('title', 'TCP - Edit Vendor')

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
            <i class="uil uil-store"></i>
            <span class="text">Edit Vendor</span>
        </div>
        <div class="form-container">
            <form action="/vendors/{{ $vendor->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Vendor Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter vendor name..." required
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $vendor->name) }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter email..." required
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $vendor->email) }}">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter address..." required
                        class="form-control @error('address') is-invalid @enderror"
                        value="{{ old('address', $vendor->address) }}">
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter phone number..." required
                        class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $vendor->phone) }}">
                    @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="/vendors" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
