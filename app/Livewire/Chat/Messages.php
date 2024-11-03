<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use App\Models\Room;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Messages extends Component
{
    public Room $room;

    /**
     * @var Collection<Message>
     */
    public Collection $messages;

    public function mount(): void
    {
        $this->fill([
            'messages' => $this->room->messages()->with(['user'])->oldest()->limit(100)->get(),
        ]);
    }

    #[On('message.created')]
    public function prependMessage(int $id): void
    {
        $this->messages->push(Message::with('user')->find($id));
    }

    public function render()
    {
        return view('livewire.chat.messages');
    }
}
