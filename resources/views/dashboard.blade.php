<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div
                    class="p-6 text-gray-900"
                    x-data="{
                        dispatched: false,
                        order: null
                    }"
                    x-init="
                        Echo.private('users.{{ auth()->id() }}')
                            .listen('OrderDispatched', (event) => {
                                dispatched = true
                                order = event.order
                                console.log(event)
                            })
                    "
                >
                    {{ __("You're logged in!") }}
                    <template x-if="dispatched">
                        <p>Order (# <span x-text="order.id"></span>) has bin dispatched!</p>
                    </template>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
