@extends('layouts.main')

@section('title', 'TCP - Edit Project')

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
            <span class="text">Edit Project</span>
        </div>
        <div class="form-container">
            <form action="/projects/{{ $project->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Project Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter project name..." required
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $project->name) }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="project_value">Project Value</label>
                    <input type="number" id="project_value" name="project_value" placeholder="Enter project value..."
                        required class="form-control @error('project_value') is-invalid @enderror"
                        value="{{ old('project_value', $project->project_value) }}">
                    @error('project_value')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" placeholder="Enter project location..." required
                        class="form-control @error('location') is-invalid @enderror"
                        value="{{ old('location', $project->location) }}">
                    @error('location')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="client_id">Client</label>
                    <select name="client_id" id="client_id"
                        class="form-control select-client @error('client_id') is-invalid @enderror" required>
                        <option value="">Select Client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}"
                                {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ipa_baja_id">IPA Baja</label>
                    <select name="ipa_baja_id" id="ipa_baja_id"
                        class="form-control @error('ipa_baja_id') is-invalid @enderror" required>
                        <option value="">Select IPA Baja</option>
                        @foreach ($ipaBajas as $ipaBaja)
                            <option value="{{ $ipaBaja->id }}"
                                {{ old('ipa_baja_id', $project->ipa_baja_id) == $ipaBaja->id ? 'selected' : '' }}>
                                {{ $ipaBaja->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('ipa_baja_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                        required>
                        <option value="">Select Status</option>
                        <option value="ongoing" {{ old('status', $project->status) == 'ongoing' ? 'selected' : '' }}>
                            Ongoing
                        </option>
                        <option value="finished" {{ old('status', $project->status) == 'finished' ? 'selected' : '' }}>
                            Finished
                        </option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deadline">Deadline Date</label>
                    <input type="date" id="deadline" name="deadline" required
                        class="form-control @error('deadline') is-invalid @enderror"
                        value="{{ old('deadiline', \Carbon\Carbon::parse($project->deadline)->format('Y-m-d')) }}">
                    @error('deadline')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="/projects" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
