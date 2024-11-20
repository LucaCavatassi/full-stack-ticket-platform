@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create New Ticket</h1>

        <!-- Form to create a new ticket -->
        <form action="{{ route('admin.tickets.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" 
                          id="description" 
                          class="form-control @error('description') is-invalid @enderror" 
                          rows="4" 
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status_id" class="form-label">Status</label>
                <select name="status_id" 
                        id="status_id" 
                        class="form-select @error('status_id') is-invalid @enderror" 
                        required>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}" 
                                {{ old('status_id', 4) == $status->id ? 'selected' : '' }}>
                            {{ $status->title }}
                        </option>
                    @endforeach
                </select>
                @error('status_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="agent_id" class="form-label">Agent</label>
                <select name="agent_id" 
                        id="agent_id" 
                        class="form-select @error('agent_id') is-invalid @enderror" 
                        required>
                    @foreach ($agents as $agent)
                        <option value="{{ $agent->id }}" 
                                {{ old('agent_id') == $agent->id ? 'selected' : '' }}>
                            {{ $agent->name }}
                        </option>
                    @endforeach
                </select>
                @error('agent_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" 
                        id="category_id" 
                        class="form-select @error('category_id') is-invalid @enderror" 
                        required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Ticket</button>
        </form>
    </div>
@endsection