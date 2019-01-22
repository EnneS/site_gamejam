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
      // ADMINS
      DB::table('students')->insert([
        [
          'id' => 1,
          'login' => 'admin',
          'first_name' => 'Admin',
          'last_name' => '',
          'admin' => 1,
        ],
        [
          'id' => 2,
          'login' => 'bertolip',
          'first_name' => 'Pascal',
          'last_name' => 'Bertolino',
          'admin' => 1,
        ],
        [
          'id' => 3,
          'login' => 'chevallj',
          'first_name' => 'Jean-Pierre',
          'last_name' => 'Chevallet',
          'admin' => 1,
        ],
        [
          'id' => 4,
          'login' => 'gilett',
          'first_name' => 'Théophile',
          'last_name' => 'Gilet',
          'admin' => 1,
        ],


        [
          'id' => 6,
          'login' => 'caillolf',
          'first_name' => 'Florian',
          'last_name' => 'Caillol',
          'admin' => 1,
        ],
        [
          'id' => 7,
          'login' => 'royetju',
          'first_name' => 'Julian',
          'last_name' => 'Royet',
          'admin' => 1,
        ],
      ]);
      // STUDENTS
      DB::table('students')->insert([
        [
          'id' => 5,
          'login' => 'souliern',
          'first_name' => 'Nathan',
          'last_name' => 'Soulier',
          'admin' => 0,
          'team_id' => 1
        ],
        [
          'id' => 8,
          'login' => 'dupontje',
          'first_name' => 'Jean',
          'last_name' => 'Dupont',
          'team_id' => null,
          'admin' => 0,
        ],
        [
          'id' => 9,
          'login' => 'doejohn',
          'first_name' => 'John',
          'last_name' => 'Doe',
          'team_id' => 1,
          'admin' => 0,
        ],
        [
          'id' => 10,
          'login' => 'doejane',
          'first_name' => 'Jane',
          'last_name' => 'Doe',
          'team_id' => 1,
          'admin' => 0,
        ],
      ]);

      DB::table('join_requests')->insert([
        [
          'team_id' => 1,
          'student_id' => 8,
        ],
      ]);
    }
}
