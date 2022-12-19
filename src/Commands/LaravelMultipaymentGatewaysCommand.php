<?php

namespace MusahMusah\LaravelMultipaymentGateways\Commands;

use Illuminate\Console\Command;

class LaravelMultipaymentGatewaysCommand extends Command
{
    public $signature = 'laravel-multipayment-gateways';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
