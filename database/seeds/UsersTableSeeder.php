<?php

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
        DB::table('users')->insert([
            'first_name' => 'Дмитрий',
            'last_name' => 'Иванов',
            'nickname' => 'Якудза',
            'email' => 'admin@admin.by',
            'password' => Hash::make('3121985'),
            'avatar' => 'avatars/1/8SJDx5YKdQ60z36Ce6qteDAkeYTFBZBt76MYTWDC.jpeg',
            'verified' => true,
            'remember_token' => str_random(50),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
