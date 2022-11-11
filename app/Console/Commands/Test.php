<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = 'C:\Users\andru\OneDrive\Рабочий стол\лабы для пацанов\application\storage\app\cron.txt';

        file_put_contents($file,"Laravel круто, node - кал\n",FILE_APPEND);
        return 0;
    }
}
