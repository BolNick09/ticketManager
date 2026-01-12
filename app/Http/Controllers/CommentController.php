<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $user = Auth::user();

        if ($user->role->name === 'user' && $ticket->user_id !== $user->id) 
            abort(403);
        

        $request->validate([
            'body' => 'required|string',
        ]);

        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'body' => $request->body,
        ]);

        return redirect()->route('tickets.show', $ticket);
    }
}
