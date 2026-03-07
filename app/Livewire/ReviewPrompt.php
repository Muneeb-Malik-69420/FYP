<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Review;
use Livewire\Component;

class ReviewPrompt extends Component
{
    public ?Order $order = null;
    public int $rating   = 0;
    public bool $show    = false;
    public bool $done    = false;

    protected $listeners = ['promptReview' => 'load'];

    public function load(int $orderId): void
    {
        $order = Order::with('items.foodItem')->find($orderId);

        if (
            !$order ||
            $order->user_id !== auth()->id() ||
            !$order->isDelivered() ||
            $order->isReviewed()
        ) {
            return;
        }

        $this->order = $order;
        $this->rating = 0;
        $this->done = false;
        $this->show = true;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function submit(): void
    {
        if (!$this->order || $this->rating < 1 || $this->rating > 5) return;

        $supplierId = $this->order->supplier_id;
        if (!$supplierId) return;

        Review::create([
            'user_id'     => auth()->id(),
            'supplier_id' => $supplierId,
            'order_id'    => $this->order->id,
            'rating'      => $this->rating,
        ]);

        $this->done = true;

        $this->dispatch('show-toast',
            message: 'Thanks for your review!',
            type: 'success'
        );

        // Auto close after 1.5s via Alpine
    }

    public function dismiss(): void
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.review-prompt');
    }
}