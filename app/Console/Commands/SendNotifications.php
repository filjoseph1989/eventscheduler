<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Event;

/**
 * Send event reminder in the background
 * 
 * @author Janica Liz <janicalizdeguzman@gmail.com>
 * @version 1.0.0
 * @date 11-05-2017
 * @date 11-05-2017 - updated
 */
class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will sent a reminder of the event to organization members';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        var_dump(self::getEvents);
    }

    /**
     * Return the list of upcoming events
     *
     * @return array|object
     */
    private function getEvents()
    {
        return Event::with('organization')
            ->where('category', 'organizations')
            ->orWhere('category', 'within')
            ->where('status', 'upcoming')
            ->where('is_approve', 'true')
            ->whereYear("date_start", '=', date('Y'))
            ->whereMonth('date_start','>=',date('m'))
            ->get();
    }
}
