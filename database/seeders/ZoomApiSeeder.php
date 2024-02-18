<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoomApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zoom_apis')->insert([
            'id' => 1,
            'user_id' => 1,
            'api_key' => env('ZOOM_API_KEY'),
            'api_secret' => env('ZOOM_API_SECRET'),
            'status' => 0,
            'active' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
