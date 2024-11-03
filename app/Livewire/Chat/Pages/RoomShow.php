<?php

namespace App\Livewire\Chat\Pages;

use App\Models\Message;
use App\Models\Room;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class RoomShow extends Component
{
    public Room $room;

    #[Rule('required')]
    public string $body = '';

    public function submit(): void
    {
        $this->validate();

        $message = Message::create([
            'user_id' => auth()->id(),
            'room_id' => $this->room->id,
            'body' => $this->body,
        ]);
        $this->reset('body');
        $this->dispatch('message.created', $message->id);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.chat.pages.room-show');
    }
}
