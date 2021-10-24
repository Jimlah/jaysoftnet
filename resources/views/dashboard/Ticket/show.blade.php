<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('View Ticket') }}
            </h2>
        </div>
    </x-slot>

    <div>
        <div class="flex flex-col p-6 space-y-5 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold capitalize text-opacity-70">
                    {{ $ticket->title }}
                </h2>
                @if (auth()->user()->is_admin)
                    <span class="text-sm font-bold">
                        {{ $ticket->user->name }}
                    </span>
                @endif
            </div>
            <p class="font-medium text-opacity-70">
                {{ $ticket->description }}
            </p>
            <p class="text-lg text-semibold">
                <span class="text-sm font-medium text-opacity-50">
                    {{ __('Created') }}:
                </span>
                {{ $ticket->created_at->diffForHumans() }}
            </p>
            <div class="flex items-center justify-between">
                <p class="text-lg text-semibold">
                    <span class="text-sm font-medium text-opacity-50">
                        {{ __('Status') }}:
                    </span>
                    <span class="capitalize {{ $ticket->closed_at ? "text-blue-500" : "text-green-500" }}">{{ $ticket->status }}</span>
                </p>
                <p class="text-sm text-semibold">
                    {{ $ticket->closed_at }}
                </p>
            </div>

        </div>

    </div>
    </div>



</x-app-layout>
