<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('students')->insert([
        [
          'id' => 1,
          'login' => 'admin',
          'first_name' => 'admin',
          'last_name' => 'admin',
          'team_id' => null,
          'admin' => 1,
        ],
        [
          'id' => 2,
          'login' => 'gilett',
          'first_name' => 'Théophile',
          'last_name' => 'Gilet',
          'team_id' => 1,
          'admin' => 0,
        ],
      ]);
    }
}
