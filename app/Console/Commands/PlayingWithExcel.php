<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Excel;

class PlayingWithExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.-
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
        $var = Excel::load(database_path('G98.xls'),function($reader){
                $title = $reader->getTitle();

                $employees = collect($reader->toArray())->collapse()->reject(function($read){
                    return empty($read);
                });
                $headers = $reader->first()->collapse()->keys()->all(); // gets the excel header (for table)
                $this->table($headers, $employees->toArray());
        });
    }
}
