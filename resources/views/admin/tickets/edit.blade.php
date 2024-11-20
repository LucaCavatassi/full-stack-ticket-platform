@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Ticket</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to edit ticket -->
        <form action="{{ route('admin.tickets.update', $ticket->slug) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Title Field (disabled) -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $ticket->title) }}" disabled>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description Field (disabled) -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" disabled>{{ old('description', $ticket->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status Field -->
            <div class="mb-3">
                <label for="status_id" class="form-label">Status</label>
                <select name="status_id" id="status_id" class="form-select @error('status_id') is-invalid @enderror" required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" {{ old('status_id', $ticket->status_id) == $status->id ? 'selected' : '' }}>
                            {{ $status->title }}
                        </option>
                    @endforeach
                </select>
                @error('status_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Agent Field (disabled)-->
            <div class="mb-3">
                <label for="agent_id" class="form-label">Agent</label>
                <select name="agent_id" id="agent_id" class="form-select @error('agent_id') is-invalid @enderror" disabled>
                    @foreach ($agents as $agent)
                        <option value="{{ $agent->id }}" {{ old('agent_id', $ticket->agent_id) == $agent->id ? 'selected' : '' }}>
                            {{ $agent->name }}
                        </option>
                    @endforeach
                </select>
                @error('agent_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category Field (disabled)-->
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" disabled>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $ticket->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Ticket</button>
        </form>
    </div>
@endsection
