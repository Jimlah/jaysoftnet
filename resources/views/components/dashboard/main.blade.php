<div class="">
    <div class="flex flex-col items-center justify-start mb-10 space-y-4 sm:flex-row sm:space-x-4 sm:space-y-0">
        <div
            class="flex items-center justify-between w-full max-w-xs p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="flex flex-col items-start justify-between space-y-2">
                <span class="text-sm font-medium text-opacity-70">Open Tickets</span>
                <span class="text-3xl font-medium text-green-500">{{ $open }}</span>
                <span class="text-xs font-light text-opacity-50">{{$percentageOpen}}% open tickets</span>
            </div>
            <span class="">
                <svg class="w-16 h-16 text-green-500 text-opacity-50" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                    </path>
                </svg>
            </span>
        </div>

        <div
            class="flex items-center justify-between w-full max-w-xs p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="flex flex-col items-start justify-between space-y-2">
                <span class="text-sm font-medium text-opacity-70">Closed Tickets</span>
                <span class="text-3xl font-medium text-blue-500">{{ $closed }}</span>
                <span class="text-xs font-light text-opacity-50">{{$percentageClosed}}% closed tickets</span>
            </div>
            <span class="">
                <svg class="w-16 h-16 text-blue-500 text-opacity-50" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                    </path>
                </svg>
            </span>
        </div>
    </div>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        You're logged in!
    </div>
</div>
