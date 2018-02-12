<?php

use App\Lists;
use Illuminate\Database\Seeder;

class ListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('lists')->truncate();
        $this->createExampleList();
    }

    /**
    * Method for create fixed list
    *
    * @return void
    */
    private function createExampleList()
    {
        Lists::create([
            'name' => 'Example list',
        ]);
        $this->command->info('Example list created');
    }
}
