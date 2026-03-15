<?php

declare(strict_types=1);

namespace MusahMusah\LaravelMultipaymentGateways\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentWebhookReceivedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public array $webhookPayload) {}

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn(): Channel
    {
        return new PrivateChannel('channel-name');
    }
}
