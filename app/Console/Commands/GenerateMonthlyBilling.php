<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BillingService;
use Carbon\Carbon;

class GenerateMonthlyBilling extends Command
{
    protected $signature = 'billing:generate {--month=} {--year=}';
    protected $description = 'Generate tagihan bulanan';

    public function handle(BillingService $billing)
    {
        $month = $this->option('month') ?? now()->month;
        $year  = $this->option('year') ?? now()->year;

        $billing->generate(Carbon::create($year, $month, 1));

        $this->info("Billing {$month}/{$year} generated.");
    }
}
