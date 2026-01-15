<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role->name === 'user') 
            $tickets = Ticket::where('user_id', $user->id)->get();
        else if ($user->role->name === 'agent') 
            $tickets = Ticket::where('agent_id', Auth::id())->get();
        else 
            $tickets = Ticket::all();
       

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'status' => 'open',
        ]);

        return redirect()->route('tickets.index');
    }

    public function show(Ticket $ticket)
    {
    // $this->authorize('view', $ticket);    
    $user = Auth::user();

        if ($user->role->name === 'user' && $ticket->user_id !== $user->id) 
            abort(403);
        

        $ticket->load(['comments.user', 'category', 'agent']);

        $agents = [];

        if (Auth::user()->role->name === 'admin') {
            $agents = User::whereHas('role', function ($q) {
                $q->where('name', 'agent');
            })->get();
}

return view('tickets.show', compact('ticket', 'agents'));
    }
    public function take(Ticket $ticket)
    {
        $user = Auth::user();

        if (!in_array($user->role->name, ['agent', 'admin'])) 
            abort(403);
        

        $ticket->update([
            'agent_id' => $user->id,
            'status' => 'in_progress',
        ]);

        return redirect()->route('tickets.show', $ticket);
    }
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $user = Auth::user();

        if (!in_array($user->role->name, ['agent', 'admin'])) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:open,in_progress,waiting_user,closed',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return redirect()->route('tickets.show', $ticket);
    }
    public function close(Ticket $ticket)
    {
        $user = Auth::user();

        if ($ticket->user_id !== $user->id) {
            abort(403);
        }

        $ticket->update([
            'status' => 'closed',
        ]);

        return redirect()->route('tickets.show', $ticket);
    }
    public function assignAgent(Request $request, Ticket $ticket)
{
    $user = Auth::user();

    if ($user->role->name !== 'admin') {
        abort(403);
    }

    $request->validate([
        'agent_id' => 'required|exists:users,id',
    ]);

    $agent = User::findOrFail($request->agent_id);

    if ($agent->role->name !== 'agent') {
        abort(403);
    }

    $ticket->update([
        'agent_id' => $agent->id,
        'status' => 'in_progress',
    ]);

    return redirect()->route('tickets.show', $ticket);
}


}
