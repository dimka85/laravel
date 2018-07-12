<?php

use Illuminate\Database\Seeder;

class GameTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('game_types')->insert([
            'game_type' => 'Классическая мафия',
            'min' => 10,
            'max' => 10,
        ]);
    }
}
