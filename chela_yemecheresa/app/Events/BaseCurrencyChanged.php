<?php

namespace App\Events;

use App\Models\currency_manager;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BaseCurrencyChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
  public $oldbasecurrency;
  public $newbasecurrency;
    /**
     * Create a new event instance.
     */
    public function __construct(currency_manager $oldbasecurrency,currency_manager $newbasecurrency)
    {
        $this->oldbasecurrency=$oldbasecurrency;
        $this->newbasecurrency=$newbasecurrency;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
