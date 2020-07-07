<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Status::insert([
            ['title' => 'Not started', 'order' => 1],
            ['title' => 'In progress', 'order' => 2],
            ['title' => 'Finished', 'order' => 3]
        ]);
    }
}
