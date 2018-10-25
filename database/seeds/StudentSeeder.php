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
          'login' => 'souliern',
          'first_name' => 'Nathan',
          'last_name' => 'Soulier',
          'email' => 'nathansoulier@email.email',
          'team_id' => null,
        ],
        [
          'id' => 2,
          'login' => 'gilett',
          'first_name' => 'Théophile',
          'last_name' => 'Gilet',
          'email' => 'theophilegilet@email.email',
          'team_id' => 1,
        ],
      ]);
    }
}
