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
            <span class="text">Create Item Entry</span>
        </div>
        <div class="form-container">
            <form action="/item-entries/store" method="POST">
                @csrf
                @method('POST')


                <div class="form-group">
                    <label for="item_id">Item</label>
                    <select name="item_id" id="item_id" class="form-control @error('item_id') is-invalid @enderror"
                        required>
                        <option value="">Select Item</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('item_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="vendor_id">Vendor</label>
                    <select name="vendor_id" id="vendor_id" class="form-control @error('vendor_id') is-invalid @enderror"
                        required>
                        <option value="">Select Vendor</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                {{ $vendor->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('vendor_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="total_price">Total Price</label>
                    <input type="number" id="total_price" name="total_price" placeholder="Enter total price..." required
                        class="form-control @error('total_price') is-invalid @enderror" value="{{ old('total_price') }}">
                    @error('total_price')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="payment">Payment Method</label>
                    <select name="payment" id="payment" class="form-control @error('payment') is-invalid @enderror"
                        required>
                        <option value="">Select Payment Method</option>
                        <option value="cash" {{ old('payment') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="transfer" {{ old('payment') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                        <option value="check" {{ old('payment') == 'check' ? 'selected' : '' }}>Check</option>
                    </select>
                    @error('payment')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" placeholder="Enter quantity..." required
                        class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}">
                    @error('quantity')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="entry_date">Entry Date</label>
                    <input type="date" id="entry_date" name="entry_date" required
                        class="form-control @error('entry_date') is-invalid @enderror"
                        value="{{ old('entry_date', date('Y-m-d')) }}">
                    @error('entry_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description <i>(Optional)</i></label>
                    <textarea id="description" name="description" placeholder="Enter description..."
                        class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="/item-entries" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
