<?php

namespace Tests\Browser;

use App\Models\Ticket;
use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TicketTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_admin_can_get_all_ticket_created()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('is_admin', 1)->inRandomOrder()->first();
            $browser->loginAs($user)
                    ->visitRoute('tickets.index');
            $browser->assertSee('Ticket');
        });
    }

    public function test_user_can_get_all_ticket_created()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('is_admin', 0)->inRandomOrder()->first();
            $browser->loginAs($user)
                    ->visitRoute('tickets.index');
            $browser->assertSee('Ticket');
        });
    }

    public function test_user_can_create_ticket()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('is_admin', 0)->inRandomOrder()->first();
            $browser->loginAs($user)
                    ->visitRoute('tickets.index')
                    ->clickLink('Create')
                    ->assertSee('Create Ticket')
                    ->type('title', 'Test Ticket')
                    ->type('description', 'Test Description')
                    ->press('Create Ticket')
                    ->assertSee('Ticket created successfully!');
        });
    }

    public function test_user_can_update_ticket()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('is_admin', 0)->inRandomOrder()->first();
            $user->tickets()->save(Ticket::factory()->open()->make());
            $ticket = $user->tickets->where('closed_at', null)->random();
            $browser->loginAs($user)
                    ->visitRoute('tickets.edit', $ticket->id)
                    ->assertSee('Edit Ticket')
                    ->type('title', 'Test Ticket')
                    ->type('description', 'Test Description')
                    ->press('Update Ticket')
                    ->assertSee('Ticket updated successfully!');
        });
    }

    public function test_user_can_close_ticket()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('is_admin', 0)->inRandomOrder()->first();
            $user->tickets()->save(Ticket::factory()->open()->make());
            $ticket = $user->tickets->where('closed_at', null)->random();
            $browser->loginAs($user)
                    ->visitRoute('ticket.status', $ticket->id)
                    ->assertSee('Ticket closed successfully');
        });
    }

    public function test_user_can_not_edit_closed_ticket()
    {
        $this->browse(function (Browser $browser) {
            $user = User::where('is_admin', 0)->inRandomOrder()->first();
            $user->tickets()->save(Ticket::factory()->make());
            $ticket = $user->tickets->where('closed_at')->random();
            $browser->loginAs($user)
                    ->visitRoute('tickets.edit', $ticket->id)
                    ->assertSee('Ticket is closed!');
        });
    }

}
