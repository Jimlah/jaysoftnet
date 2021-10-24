<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\TicketFormRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::with('user')->latest('id')->paginate(10);
        return view('dashboard.Ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticket = new Ticket();
        return view('dashboard.Ticket.create', compact('ticket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketFormRequest $request)
    {
        $ticket = new Ticket($request->validated());
        $ticket->save();
        return redirect(route('tickets.index'))->with('message', [
            'type' => 'success',
            'text' => 'Ticket created successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('dashboard.Ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        if ($ticket->closed_at) {
            return redirect(route('tickets.index'))->with('message', [
                'type' => 'error',
                'text' => 'Ticket is closed!'
            ]);
        }

        return view('dashboard.Ticket.create', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(TicketFormRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());
        return redirect(route('tickets.index'))->with('message', [
            'type' => 'success',
            'text' => 'Ticket updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect(route('tickets.index'))->with('message', [
            'type' => 'success',
            'text' => 'Ticket deleted successfully'
        ]);
    }
}
