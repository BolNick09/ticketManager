<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    /**
     * Просмотр тикета
     */
    public function view(User $user, Ticket $ticket): bool
    {
        $role = $user->role->name;

        // Админ видит всё
        if ($role === 'admin') {
            return true;
        }

        // Пользователь — только свои тикеты
        if ($role === 'user') {
            return $ticket->user_id === $user->id;
        }

        // Агент — только назначенные
        if ($role === 'agent') {
            return $ticket->agent_id === $user->id;
        }

        return false;
    }
}
