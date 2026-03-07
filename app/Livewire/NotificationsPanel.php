<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;

class NotificationsPanel extends Component
{
    public bool $open = false;

    protected $listeners = ['notificationCreated' => '$refresh'];
    // protected $listeners = ['notification-created' => '$refresh'];


    public function openPanel(): void
    {
        $this->open = true;
    }

    public function toggle(): void
    {
        $this->open = !$this->open;
    }

    public function markAllRead(): void
    {
        Notification::where('user_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    public function markRead(int $id): void
    {
        Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->update(['read_at' => now()]);
    }

    public function getUnreadCountProperty(): int
    {
        return Notification::where('user_id', auth()->id())
            ->unread()
            ->count();
    }

    public function render()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->take(10)
            ->get();

        return view('livewire.notifications-panel', [
            'notifications' => $notifications,
            'unreadCount'   => $this->unreadCount,
        ]);
    }
}