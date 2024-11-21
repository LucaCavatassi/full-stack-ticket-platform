<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Category;
use App\Models\Status;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with(['status', 'agent', 'category'])
            ->orderBy('status_id', 'asc')
            ->orderBy('updated_at', 'asc')
            ->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pass related data to the view for status, agent, and category
        $statuses = Status::all();    // Fetch all statuses
        $agents = Agent::all();       // Fetch all agents
        $categories = Category::all(); // Fetch all categories

        return view('admin.tickets.create', compact('statuses', 'agents', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:50|min:4',
            'description' => 'required|string|min:15',
            'status_id' => 'required|exists:statuses,id',
            'agent_id' => 'required|exists:agents,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Create a new ticket
        $ticket = Ticket::create([
            'date' => NOW(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status_id' => $validated['status_id'],
            'agent_id' => $validated['agent_id'],
            'category_id' => $validated['category_id'],
            'slug' => null,
        ]);

        $createMessage = "Ticket <strong><i>{$ticket->title}</i></strong> created successfully!";
        // Redirect to the ticket show page (or to the index page, etc.)
        return redirect()->route('admin.tickets.show', $ticket->slug)->with('success', $createMessage);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // Eager load the related models (status, agent, category)
        $ticket = Ticket::with('status', 'agent', 'category')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('admin.tickets.show', compact('ticket'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        // Eager load the related models (status, agent, category)
        $ticket = Ticket::with('status', 'agent', 'category')
            ->where('slug', $slug)
            ->firstOrFail();

        // Fetch other necessary data for the form (statuses, agents, categories)
        $statuses = Status::all();
        $agents = Agent::all();
        $categories = Category::all();
        // Return the edit view with the ticket and all data
        return view('admin.tickets.edit', compact('ticket', 'statuses', 'agents', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        // Validate only the status field
        $validated = $request->validate([
            'status_id' => 'required|exists:statuses,id',
        ]);

        // Find the ticket by slug
        $ticket = Ticket::where('slug', $slug)->firstOrFail();

        $updateMessage = "Ticket <strong><i>{$ticket->title}</i></strong> status updated successfully!";
        // Update the ticket's status
        $ticket->update($validated);

        // Redirect to the tickets index with a success message
        return redirect()->route('admin.tickets.index')->with('success', $updateMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $ticket = Ticket::with('status', 'agent', 'category')
            ->where('slug', $slug)
            ->firstOrFail();

        // Delete the ticket
        $ticket->delete();

        // Create success message
        $successMessage = "Ticket <strong><i>{$ticket->title}</i></strong> deleted successfully!";

        // Redirect to the index page with the success message
        return redirect()->route('admin.tickets.index')->with('success', $successMessage);
    }

    public function filter(Request $request)
    {
        // Start with the base query
        $query = Ticket::with(['status', 'agent', 'category']);

        // Apply filters dynamically based on request parameters
        if ($request->has('status_id')) {
            $query->where('status_id', $request->get('status_id'));
        }

        // Check for other filters and apply them
        if ($request->has('agent_id')) {
            $query->where('agent_id', $request->get('agent_id'));
        }

        if ($request->has('category_id')) {
            $query->where('category_id', $request->get('category_id'));
        }

        $query->orderBy('status_id', 'asc')
            ->orderBy('updated_at', 'asc');

        $tickets = $query->get();

        return view('admin.tickets.index', compact('tickets'));
    }
}
