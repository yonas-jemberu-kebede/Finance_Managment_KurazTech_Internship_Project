<?php

namespace App\Console\Commands;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;
use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run the database backup';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        BackupJobFactory::createFromArray(config('backup'))->run();

        $this->info('Backup completed successfully.');
    }
}
