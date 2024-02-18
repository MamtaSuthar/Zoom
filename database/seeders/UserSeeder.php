<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'emp_id'=>'EMP/WEB/001',
            'uuid'=>Str::uuid()->toString(),
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@softui.com',
            'password' => Hash::make('secret'),
            'designation'=> 'admin',
            'role'=> '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
