<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div
                    class="p-6 text-gray-900"
                    x-data="{
                        userPositions: []
                    }"
                    x-init="
                        const channel = Echo.private('app')
                        let width = window.innerWidth
                        let height = window.innerHeight

                        channel.listenForWhisper('mousemove', (event) => {
                            const user = userPositions.find(p => p.user.id === event.user.id)
                            if (!user) {
                                userPositions.push(event)
                                return
                            }
                            user.position = {
                                x: event.position.x * width,
                                y: event.position.y * height
                            }
                        })

                        onmousemove = (e) => {
                            channel.whisper('mousemove', {
                                user: {{ json_encode(auth()->user()->only('id', 'name'))}},
                                position: {
                                    x: e.x / width,
                                    y: e.y / height
                                }
                            })
                        }
                    "
                >
                    <template x-for="user in userPositions">
                    <div
                        class="bg-blue-200 absolute flex h-3 items-center leading-none space-x-1"
                        x-bind:style="`left: ${user.position.x}px; top: ${user.position.y}px`"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672Zm-7.518-.267A8.25 8.25 0 1 1 20.25 10.5M8.288 14.212A5.25 5.25 0 1 1 17.25 10.5" />
                        </svg>
                        <span class="text-sm font-semibold" x-text="user.user.name"></span>
                    </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
