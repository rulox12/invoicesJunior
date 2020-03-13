<?php

namespace App\Console\Commands;

use App\Entities\Invoice;
use Illuminate\Console\Command;

class updateInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updateInvoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command valid for update all overdue invoices';

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
        Invoice::whereDate('due_date', '<', date('Y-m-d'))
            ->where('state', '!=', 'Approved')
            ->update(['state' => 'Expired']);
    }
}
