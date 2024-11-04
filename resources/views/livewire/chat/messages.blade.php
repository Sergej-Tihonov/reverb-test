<div class="h-64 overflow-y-scroll rounded border border-gray-200 p-4">
  <div class="[overflow-anchor:none] space-y-4">
    @foreach($messages as $message)
      <livewire:chat.message :message="$message" :key="$message->id" />
    @endforeach
  </div>
  <div
    x-init="$el.scrollIntoView()"
    class="[overflow-anchor:auto] h-px"
  >
  </div>
</div>
