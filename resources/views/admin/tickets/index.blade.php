@extends('layouts.admin')

@section('content')
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
            <hr>
        @endforeach
    @endif
@endsection