<?php

namespace CriticalCodes\Zaggy\Commands;

use Illuminate\Console\Command;

class ZaggyCommand extends Command
{
    public $signature = 'zaggy';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
