<div class="flex space-x-3">
  <img
    src="{{ $message->user->avatar() }}"
    alt="{{ $message->user->name }}"
    class="rounded-lg size-12"
  />
  <div>
    <div class="flex items-baseline space-x-2">
      <div class="font-bold">{{ $message->user->name }}</div>
      <span class="text-xs text-gray-600">{{ $message->created_at }}</span>
    </div>
    <p>{{ $message->body }}</p>
  </div>
</div>
