<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'role_name' => 'Мирный житель',
                'basic' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'Мафия',
                'basic' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'Шериф',
                'basic' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => 'Дон',
                'basic' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
