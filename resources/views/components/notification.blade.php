@if (session('message'))
    <div x-data="notify()">
        <div class="py-2 px-4 overflow-hidden rounded-md shadow-md mb-2 flex items-center justify-between {{ session('message')['type'] == 'success' ? 'bg-green-500' : 'bg-red-500' }}"
            :class="{'hidden': hide }">
            <!-- Simplicity is an acquired taste. - Katharine Gerould -->
            <div class="flex items-center justify-start space-x-5 text-white">
                <span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                </span>
                <span>
                    {{ session('message')['text'] }}
                </span>
            </div>
            <button class="text-white" x-on:click="closeNotify()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>
@endif
<script>
    const notify = () => ({
        hide: false,
        closeNotify() {
            this.hide = true;
        },
        openNotify() {
            this.hide = false;
        }
    })
</script>
