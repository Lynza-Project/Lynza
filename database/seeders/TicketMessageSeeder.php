<?php

namespace Database\Seeders;

use App\Models\TicketMessage;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Random\RandomException;

class TicketMessageSeeder extends Seeder
{
    /**
     * @throws RandomException
     */
    public function run(): void
    {
        $tickets = Ticket::all();
        $users = User::all();

        foreach ($tickets as $ticket) {
            for ($i = 1; $i <= random_int(1, 5); $i++) {
                TicketMessage::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $users->random()->id,
                    'content' => 'Message ' . $i . ' pour le ticket ' . $ticket->id,
                ]);
            }
        }
    }
}
