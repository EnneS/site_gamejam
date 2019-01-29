<?php

use Illuminate\Database\Seeder;

class HallOfFameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('hall_of_fame')->insert([
        [
          'id' => 1,
          'year' => 2018,
        ],
        [
          'id' => 2,
          'year' => 2019,
        ],
        [
          'id' => 3,
          'year' => 2020,
        ],
        [
          'id' => 4,
          'year' => 2021,
        ],
        [
          'id' => 5,
          'year' => 2022,
        ],
      ]);

      DB::table('games')->insert([
        [
          'id' => 1,
          'name' => 'Omotecy',
          'description' => 'Omotecy',
          'hash' => 'aaaa',
          'hall_of_fame_id' => 1
        ],
        [
          'id' => 2,
          'name' => 'The Amazing Awakening of The Overpowered Genius',
          'description' => 'The Amazing Awakening of The Overpowered Genius',
          'hash' => 'aaab',
          'hall_of_fame_id' => 1
        ],
        [
          'id' => 3,
          'name' => 'En Bas',
          'description' => 'En Bas',
          'hash' => 'aaac',
          'hall_of_fame_id' => 1
        ]
      ]);
    }
}
