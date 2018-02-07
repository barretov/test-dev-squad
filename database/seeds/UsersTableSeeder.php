<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate();
        $this->createFixedUsers();
        $this->createUsers();
    }

    /**
     * Method for create fixed users
     *
     * @return void
     */
    private function createFixedUsers()
    {
        User::create([
            'email' => 'victor.eduardo.barreto@gmail.com',
            'name'  => 'Victor Eduardo Barreto',
            'password' => bcrypt('123456')
        ]);
        $this->command->info('Administrator created');
    }

    /**
     * Method for create data mass users
     *
     * @return void
     */
    private function createUsers()
    {
        $max = rand(10, 30);
        for ($i=0; $i < $max; $i++) {
            $this->createUser($i);
        }
        $this->command->info($max . ' data mass of users created');
    }

    /**
     * Method for create data mass users
     *
     * @param  int $index Index
     * @return int Result of insertion
     */
    private function createUser($index)
    {
        return User::create([
            'email' => 'email' . $index . '@mail.com',
            'name'  =>'User '. $index,
            'password' => bcrypt('123456')
        ]);
    }
}
