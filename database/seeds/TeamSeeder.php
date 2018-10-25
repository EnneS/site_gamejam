<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('games')->insert([
        [
          'id' => 1,
          'name' => 'Mon premier jeu',
          'description' => 'Ma super description',
          'team_id' => 1,
        ]
      ]);

      DB::table('teams')->insert([
        [
          'id' => 1,
          'name' => 'Ma première équipe',
          'game_id' => 1,
          'group_id' => 1,
        ],
      ]);
    }
}
