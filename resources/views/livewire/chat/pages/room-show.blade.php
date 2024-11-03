<x-slot name="header">
  <h2 class="text-xl font-semibold leading-tight text-gray-800">
    {{ $room->name }}
  </h2>
</x-slot>

<div class="py-12">
  <div class="mx-auto grid max-w-7xl grid-cols-12 gap-6 sm:px-6 lg:px-8">
    <div class="col-span-3 overflow-hidden bg-white shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900">
        Users
      </div>
    </div>
    <div class="col-span-9 flex flex-col gap-6 overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg">
      <div class="">
        Messages
      </div>
      <form
        x-data="{
          shift: false
        }"
        x-on:keydown.shift="shift = true"
        x-on:keyup.shift="shift = false"
        x-on:keydown.enter="if (!shift && !$event.target.valu) { $event.preventDefault() }"
        x-on:keyup.enter.prevent="if (!shift && $event.target.value) { $wire.submit() }"
        class=""
      >
        <label for="body" class="sr-only">Message</label>
        <textarea id="body"
                  name="body"
                  wire:model="body"
                  rows="4"
                  placeholder="say something"
                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        ></textarea>
      </form>
    </div>
  </div>
</div>
