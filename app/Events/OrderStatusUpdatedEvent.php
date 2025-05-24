<?php

namespace App\Events;

use Domains\Order\Models\Order;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * Create a new event instance.
     */
    public function __construct(
        public Order $order,
        public string $status,
    )
    {}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn(): array
    {
        $channels = [];

        foreach ($this->order->workers as $worker) {
            $channels[] = new PrivateChannel('worker.' . $worker->id);
        }

        return $channels;
    }

    public function broadcastWith(): array
    {
        return [
            'order' => $this->order,
            'status' => $this->status,
        ];
    }
}
