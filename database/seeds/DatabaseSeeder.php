<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HallOfFameSeeder::class);
        $this->call(RuleSeeder::class);
        $this->call(StepSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(StudentSeeder::class);
    }
}
