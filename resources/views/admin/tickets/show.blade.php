@extends('layouts.admin')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {!! session('success') !!}
    </div>
@endif

<div class="ticket-detail">
    <h1>{{ $ticket->title }}</h1>
    <p><strong>Status:</strong> {{ $ticket->status->title ?? 'No Status' }}</p>
    <p><strong>Agent:</strong> {{ $ticket->agent->name ?? 'No Agent Selected' }}</p>
    <p><strong>Category:</strong> {{ $ticket->category->title ?? 'No Category Selected' }}</p>
    <p><strong>Description:</strong> {{ $ticket->description }}</p>
    <p><strong>Created At:</strong> {{ $ticket->created_at->format('M d, Y') }}</p>
    <p><strong>Updated At:</strong> {{ $ticket->updated_at->format('M d, Y') }}</p>
    <form action="{{route('admin.tickets.edit', $ticket->slug)}}" method="GET">
        <button class="btn btn-primary">Edit</button>
    </form>
    <form action="{{route('admin.tickets.destroy', $ticket->slug)}}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Delete</button>
    </form>

</div>
@endsection