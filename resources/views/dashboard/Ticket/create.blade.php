<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ !$ticket->id? __('Create Ticket') : __('Edit Ticket') }}
            </h2>
        </div>
    </x-slot>

    <div>
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form action={{ $ticket->id ? route('tickets.update', $ticket->id) : route('tickets.store') }}
                method="POST">
                <div class="grid gap-6">
                    @csrf
                    @if ($ticket->id)
                        @method('PUT')
                    @endif
                    <div class="space-y-2">
                        <x-label for="title" :value="__('Title')" />
                        <x-input id="title" class="block w-full" type="text" name="title"
                            :value="old('title', $ticket?->title)" placeholder="{{ __('Title') }}" required
                            autofocus />

                    </div>
                    <div class="space-y-2">
                        <x-label for="description" :value="__('Description')" />
                        <x-text-area id="description" class="block w-full h-48 resize-none" name="description"
                            placeholder="{{ __('Description') }}" required autofocus>
                            {{ old('description', $ticket?->description) }}</x-text-area>

                    </div>
                    <div>
                        <x-button class="justify-center w-full gap-2">
                            <span>
                                @if (url()->current() == route('tickets.create'))
                                    {{ __('Create Ticket') }}
                                @else
                                    {{ __('Update Ticket') }}
                                @endif
                            </span>
                        </x-button>
                    </div>
                </div>
            </form>

        </div>

    </div>
    </div>



</x-app-layout>
