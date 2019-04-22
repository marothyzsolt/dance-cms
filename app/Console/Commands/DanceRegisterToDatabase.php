<?php

namespace App\Console\Commands;

use App\Dancer;
use App\TypeDancer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DanceRegisterToDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dancer:register
    {id : dancer_category_id}
    {file : filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'With the command, we can write the values ​​of a category into a file';

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
        $categoryID = $this->argument('id');
        $fileName = $this->argument('file');
        if (!file_exists($fileName)) {
            $this->error('A file nem nyitható meg,vagy nem létezik!');
            exit();
        }
        $lines = file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        try {
            foreach($lines as $line) {
                $line = explode("\t", $line);
                Dancer::create([
                    'num' => $line[0],
                    'name' => $line[1],
                    'dancer_category_id' => $categoryID,
                ]);
            }
            $this->info('Sikeres insert');
        }
        catch(\Exception $e) {
            dd($e->getMessage());
        }
    }
}
