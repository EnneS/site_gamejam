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
          'password' => Hash::make('souliern'),
          'first_name' => 'Nathan',
          'last_name' => 'Soulier',
          'email' => 'nathansoulier@email.email',
        ],
        [
          'id' => 2,
          'password' => Hash::make('souliern'),
          'first_name' => 'Théophile',
          'last_name' => 'Gilet',
          'email' => 'theophilegilet@email.email',
        ],
      ]);
    }
}
