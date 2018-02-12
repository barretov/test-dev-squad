<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
        for ($i=0; $i < 10; $i++) {
            $this->createUser($i);
        }
        $this->command->info('10 Data mass of users created');
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
            'email' => 'email.user.' . $index . '@mail.com',
            'name'  =>'User Examp '. $index,
            'password' => bcrypt('123456')
        ]);
    }
}
