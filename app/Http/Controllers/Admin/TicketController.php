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
        $tickets = Ticket::with(['status', 'agent', 'category'])->get();
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
            'title' => 'required|string|max:255|min:4',
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

        // Redirect to the ticket show page (or to the index page, etc.)
        return redirect()->route('admin.tickets.show', $ticket->slug)->with('success', 'Ticket created successfully!');
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
        var_dump($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
        $successMessage = "Ticket {$ticket->name} deleted successfully!";
    
        // Redirect to the index page with the success message
        return redirect()->route('admin.tickets.index')->with('deleteSuccess', $successMessage);
    }
}
