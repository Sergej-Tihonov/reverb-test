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
    <div class="col-span-9 overflow-hidden bg-white shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900">
        Chat
      </div>
    </div>
  </div>
</div>
