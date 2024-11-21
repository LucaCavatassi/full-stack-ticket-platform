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
        <form method="GET" action="{{ route('admin.tickets.filter') }}">
            <div class="btn-group">
                <button type="submit" class="btn btn-primary" name="status_id" value="1">Assegnato</button>
                <button type="submit" class="btn btn-primary" name="status_id" value="2">In Lavorazione</button>
                <button type="submit" class="btn btn-primary" name="status_id" value="3">Chiuso</button>
                <form method="GET" action="{{route('admin.tickets.index')}}">
                    <button type="submit" class="btn btn-primary">Tutti</button>
                </form>
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