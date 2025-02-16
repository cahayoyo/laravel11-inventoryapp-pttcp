@extends('layouts.main')

@section('title', 'TCP - Edit Client')

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
            <span class="text">Edit Item</span>
        </div>
        <div class="form-container">
            <form action="/items/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id"
                        class="form-control @error('category_id') is-invalid @enderror" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Item Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter item name..." required
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $item->name) }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" name="stock" placeholder="Enter stock..." required
                        class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $item->stock) }}">
                    @error('stock')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="unit_id">Unit</label>
                    <select name="unit_id" id="unit_id" class="form-control @error('unit_id') is-invalid @enderror"
                        required>
                        <option value="">Select Unit</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}"
                                {{ old('unit_id', $item->unit_id) == $unit->id ? 'selected' : '' }}>
                                {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('unit_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Item Image <i>(Optional)</i></label>
                    <input type="file" id="image" name="image"
                        class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                @if ($item->image)
                    <div class="form-group">
                        <label for="current">Current image:</label>
                        <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}"
                            style="max-height: 150px; width: auto; object-fit: contain;">
                    </div>
                @endif


                <div class="form-actions">
                    <a href="/items" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
