<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TodoStatus;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ['View','In Progress',"Done"];
        for ($i = 0; $i < 3; $i++){
            TodoStatus::create([
                'title' => $status[$i]
            ]);
        }

    }
}
