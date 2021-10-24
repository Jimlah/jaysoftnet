<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Ticket') }}
            </h2>
        </div>
    </x-slot>

    <div x-data="modal()">
        <div
            class="flex flex-col items-start justify-start p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <a href={{ route('tickets.create') }} class="px-4 py-2 mb-5 text-white capitalize bg-blue-500 rounded hover:opacity-80">
                Create
            </a>
            <div class="w-full overflow-y-auto rounded-lg">
                <table class="w-full mb-2 text-sm font-medium rounded-md table-auto">
                    <thead>
                        <tr class="text-left bg-gray-200 border-b rounded-md dark:bg-gray-500">
                            @if (auth()->user()->is_admin)
                                <th class="px-4 py-3">User</th>
                            @endif
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Created At</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr class="font-normal border-b whitespace-nowrap">
                                @if (auth()->user()->is_admin)
                                    <td class="px-4 py-3">{{ $ticket->user->name }}</td>
                                @endif
                                <td class="px-4 py-3">{{ $ticket->title }}</td>
                                <td class="px-4 py-3">
                                    <button x-on:click="openModal({{ $ticket->id }})"
                                        class="px-4 py-2 rounded capitalize hover:opacity-80 text-white {{ $ticket->closed_at ? 'bg-green-500' : 'bg-blue-500' }}">
                                        {{ $ticket->status }}
                                    </button>
                                </td>
                                <td class="px-4 py-3">{{ $ticket->created_at }}</td>
                                <td class="flex items-center justify-start px-4 py-3">
                                    <a href="{{ route('tickets.show', $ticket) }}"
                                        class="text-green-500 hover:text-blue-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('tickets.edit', $ticket->id) }}"
                                        class="text-blue-500 hover:text-blue-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <button x-on:click="deleteModal({{ $ticket->id }})"
                                        class="text-red-500 hover:text-blue-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex items-center justify-end w-full py-5 space-x-4">
                <a href="{{ $tickets->previousPageUrl() }}"
                    class="p-2 bg-gray-200 rounded dark:bg-gray-500 hover:bg-opacity-70">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </a>
                <span class="text-sm font-normal">
                    page {{ $tickets->currentPage() }} of {{ $tickets->lastPage() }}
                </span>
                <a href={{ $tickets->nextPageUrl() }}
                    class="p-2 bg-gray-200 rounded dark:bg-gray-500 hover:bg-opacity-70">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div :class="{ 'scale-0': !open , 'scale-100': open }"
            class="fixed top-0 left-0 flex flex-col items-center justify-center w-full h-screen transition-transform duration-300 transform bg-gray-100 bg-opacity-50 dark:bg-gray-800 dark:bg-opacity-70">
            <div
                class="relative flex flex-col justify-between w-full max-w-xs p-6 space-y-5 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <button x-on:click="closeModal()" class="absolute top-0 right-0 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
                <div class="text-center" x-text="msg">
                    Are you sure you want to close this ticket?
                </div>
                <form class="flex items-center justify-end space-x-5" method="POST" :action="url">
                    @csrf
                    @method('DELETE')
                    <button x-on:click="closeModal"
                        class="px-3 py-2 rounded-md focus:outline-none ring-1 ring-red-500 hover:bg-red-500 hover:text-white">
                        Cancel
                    </button>
                    <a :href="url" :class="{ 'hidden': method !== null  }"
                        class="px-3 py-2 rounded-md focus:outline-none ring-1 ring-blue-500 hover:bg-blue-500 hover:text-white">
                        close
                    </a>
                    <button :class="{ 'hidden': method === null  }"
                        class="px-3 py-2 rounded-md focus:outline-none ring-1 ring-blue-500 hover:bg-blue-500 hover:text-white">
                        Delete
                </form>
            </div>
        </div>
    </div>
    </div>

    <script>
        const modal = () => ({
            open: false,
            url: null,
            msg: null,
            method: null,
            openModal(value) {
                this.open = true
                this.msg = 'Are you sure you want to close this Ticket'
                this.url = `/dashboard/tickets/${value}/status`
            },
            closeModal() {
                this.url = null
                this.open = false
            },
            deleteModal(value) {
                this.open = true
                this.msg = 'Are you sure you want to delete this Ticket'
                this.url = `/dashboard/tickets/${value}`
                this.method = 'delete'
            },
        })
    </script>

</x-app-layout>
