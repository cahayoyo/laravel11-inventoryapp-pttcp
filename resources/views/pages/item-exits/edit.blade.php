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
            <span class="text">Edit Item Exit</span>
        </div>
        <div class="form-container">
            <form action="/item-exits/{{ $itemExit->id }}" method="POST">
                @csrf
                @method('PUT')



                <div class="form-group">
                    <label for="item_id">Item</label>
                    <select name="item_id" id="item_id" class="form-control @error('item_id') is-invalid @enderror"
                        required>
                        <option value="">Select Item</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}"
                                {{ old('item_id', $itemExit->item_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('item_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="client_id">Client</label>
                    <select name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror"
                        required>
                        <option value="">Select Client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}"
                                {{ old('client_id', $itemExit->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="project_id">Project</label>
                    <select name="project_id" id="project_id" class="form-control @error('project_id') is-invalid @enderror"
                        required>
                        <option value="">Select Project</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}"
                                {{ old('project_id', $itemExit->project_id) == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('project_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" placeholder="Enter quantity..." required
                        class="form-control @error('quantity') is-invalid @enderror"
                        value="{{ old('quantity', $itemExit->quantity) }}">
                    @error('quantity')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exit_date">Exit Date</label>
                    <input type="date" id="exit_date" name="exit_date" required
                        class="form-control @error('exit_date') is-invalid @enderror"
                        value="{{ old('exit_date', \Carbon\Carbon::parse($itemExit->exit_date)->format('Y-m-d')) }}">
                    @error('exit_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description <i>(Optional)</i></label>
                    <textarea id="description" name="description" placeholder="Enter description..."
                        class="form-control @error('description') is-invalid @enderror">{{ old('description', $itemExit->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="/item-exits" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
