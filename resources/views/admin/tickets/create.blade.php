@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Create New Ticket</h1>

        <!-- Form to create a new ticket -->
        <form action="{{ route('admin.tickets.store') }}" method="POST">
            {{-- Token --}}
            @csrf
            {{-- Token --}}
            
            {{-- Title --}}
            <div class="mb-3">
                {{-- Label --}}
                <label for="title" class="form-label">Title</label>
                {{-- Input --}}
                {{-- If there's an error add the is-invalid tag --}}
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                {{-- Error feedback --}}
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- Title --}}

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- Description --}}

            {{-- Status --}}
            <div class="mb-3">
                <label for="status_id" class="form-label">Status</label>
                <select name="status_id" id="status_id" class="form-select @error('status_id') is-invalid @enderror" required>
                    {{-- For each status in the db make an option --}}
                    @foreach ($statuses as $status)
                        {{-- If the form has been submitted and there's an error, so  there's some old data use that  --}}
                        {{-- Else us 4 as default (Non assegnato) --}}
                        <option value="{{ $status->id }}" {{ old('status_id', 1) == $status->id ? 'selected' : '' }}>
                            {{ $status->title }}
                        </option>
                    @endforeach
                </select>
                
                @error('status_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- Status --}}

            {{-- Agent --}}
            <div class="mb-3">
                <label for="agent_id" class="form-label">Agent</label>
                <select name="agent_id" id="agent_id" class="form-select @error('agent_id') is-invalid @enderror">

                    <option disabled selected>Select an agent</option>
                    @foreach ($agents as $agent)
                        <option value="{{ $agent->id }}" {{ old('agent_id') == $agent->id ? 'selected' : '' }}>
                            {{ $agent->name }}
                        </option>
                    @endforeach
                </select>

                @error('agent_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- Agent --}}

            {{-- Category --}}
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>

                    <option disabled selected>Select a category</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- Category --}}

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary">Create Ticket</button>
        </form>
    </div>
@endsection