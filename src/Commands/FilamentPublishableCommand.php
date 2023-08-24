<?php

namespace Jaymeh\FilamentPublishable\Commands;

use Illuminate\Console\Command;

class FilamentPublishableCommand extends Command
{
    public $signature = 'filament-publishable';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
