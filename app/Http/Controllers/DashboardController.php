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
    $role = $user->role->name;

    $query = Ticket::query();

    if ($role === 'user') 
        $query->where('user_id', $user->id);
    

    if ($role === 'agent') 
        $query->where('agent_id', $user->id);
    

    return view('dashboard', [
        'open' => (clone $query)->where('status', 'open')->count(),
        'inProgress' => (clone $query)->where('status', 'in_progress')->count(),
        'waiting' => (clone $query)->where('status', 'waiting_user')->count(),
        'closed' => (clone $query)->where('status', 'closed')->count(),
    ]);
}
}