<?php

namespace App\View\Components\Dashboard;

use App\Models\Ticket;
use Illuminate\View\Component;

class Main extends Component
{

    public $closed;
    public $open;
    public $percentageClosed;
    public $percentageOpen;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $ticket = Ticket::all();

        $this->closed = $ticket->whereNotNull('closed_at')->count();
        $this->open = $ticket->where('closed_at', null)->count();

        $this->percentageClosed = floor($this->closed / ($ticket->count()) * 100);
        $this->percentageOpen = floor($this->open / ($ticket->count()) * 100);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.main');
    }
}
