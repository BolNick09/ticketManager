<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role->name === 'user') {
            $tickets = Ticket::where('user_id', $user->id);
        } else {
            $tickets = Ticket::query();
        }

        return view('dashboard', [
            'open' => $tickets->where('status', 'open')->count(),
            'inProgress' => $tickets->where('status', 'in_progress')->count(),
            'closed' => $tickets->where('status', 'closed')->count(),
        ]);
    }
}