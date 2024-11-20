@extends('layouts.admin')

@section('content')
    @if (session('deleteSuccess'))
        <div class="alert alert-primary" id="success-message">
            {{ session('deleteSuccess') }}
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
        @foreach ($tickets as $ticket)
            <div class="ticket-detail">
                <h1>{{ $ticket->title }}</h1>
                <p><strong>Status:</strong> {{ $ticket->status->title ?? 'No Status' }}</p>
                <p><strong>Agent:</strong> {{ $ticket->agent->name ?? 'No Agent Selected' }}</p>
                <p><strong>Category:</strong> {{ $ticket->category->title ?? 'No Category Selected' }}</p>
                <p><strong>Description:</strong> {{ $ticket->description }}</p>
                <p><strong>Created At:</strong> {{ $ticket->created_at->format('M d, Y') }}</p>
                <p><strong>Updated At:</strong> {{ $ticket->updated_at->format('M d, Y') }}</p>
            </div>

            <form action="{{ route('admin.tickets.show', $ticket->slug)}}" method="GET">
                <button class="btn btn-primary">View Details</button>
            </form>
            <hr>
        @endforeach
    @endif
@endsection