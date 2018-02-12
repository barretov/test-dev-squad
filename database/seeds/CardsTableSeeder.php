<?php

use App\Card;
use Illuminate\Database\Seeder;

class CardsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::table('cards')->truncate();
        $this->createExampleCards();
    }

    /**
    * Method for create fixed card
    *
    * @return void
    */
    private function createExampleCards()
    {
        Card::create([
            'idLst' => 1,
            'owner' => 1,
            'crd_order' => 0,
            'data' => "This is a example card :)",
            'crd_invite' => "",
        ]);
        $this->command->info('Example card created');
    }
}
