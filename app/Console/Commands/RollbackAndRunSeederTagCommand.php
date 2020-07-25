<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RollbackAndRunSeederTagCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafri:sourcat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rollback tabel tags and run seeder tag';

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
     * @return int
     */
    public function handle()
    {
        $this->line('Sedang Berjalan');

        $this->call('migrate:rollback');
        $this->call('migrate');

        $this->call('db:seed');

        $this->info('Berhasil Bro');
    }
}
