@extends('layouts.admin')

@section('content')
    @if (session('success'))
        <div class="alert alert-primary" id="success-message">
            {{-- {!! message !!} needed syntax to rendere html tags --}}
            {!! session('success') !!}
        </div>

        <script>
            setTimeout(function() {
                const message = document.getElementById('success-message');
                if (message) {
                    message.style.display = 'none'; // Hide the message after 4 seconds
                }
            }, 4000);
        </script>
    @endif

    @if ($tickets->isEmpty())
        <p>No tickets available.</p>
    @else
        <h1 class="pb-3">All tickets</h1>
        <div class="btn-group">
            <a href="{{ route('admin.tickets.filter', ['status_id' => 1]) }}" class="btn btn-primary {{ request('status_id') == 1 ? 'active' : '' }}">Assegnato</a>
            <a href="{{ route('admin.tickets.filter', ['status_id' => 2]) }}" class="btn btn-primary {{ request('status_id') == 2 ? 'active' : '' }}">In Lavorazione</a>
            <a href="{{ route('admin.tickets.filter', ['status_id' => 3]) }}" class="btn btn-primary {{ request('status_id') == 3 ? 'active' : '' }}">Chiuso</a>
            <a href="{{ route('admin.tickets.index') }}" class="btn btn-primary">Tutti</a>
        </div>

        <form method="GET" action="{{ route('admin.tickets.filter') }}">
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" onchange="this.form.submit()">
                    <option selected disabled>Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @foreach ($tickets as $ticket)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="ticket-detail">
                        <h1>{{ $ticket->title }}</h1>
                        <p><strong>Status - </strong> {{ $ticket->status->title ?? 'No Status' }}</p>
                        <p><strong>Last update - </strong> {{ $ticket->updated_at->format('M d, Y') }}</p>
                    </div>
        
                    <form action="{{ route('admin.tickets.show', $ticket->slug)}}" method="GET">
                        <button class="btn btn-primary">View Details</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
@endsection