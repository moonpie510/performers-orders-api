<?php

namespace App\Broadcasting;

use Domains\Worker\Models\Worker;

class OrderChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(Worker $worker, int $workerId): array|bool
    {
        return $worker->id === $workerId;
    }
}
