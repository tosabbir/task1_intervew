<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //seed admin data
        DB::table('users')->insert([

            [
                'name' => 'Admin',
                'email' => 'tosabbir313@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('123456789'),
                'created_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name' => 'User',
                'email' => 'tauhid10030@gmail.com',
                'role' => 'user',
                'password' => Hash::make('123456789'),
                'created_at' => Carbon::now()->toDateTimeString(),
            ],
        ]);

        DB::table('categories')->insert([
            [ 'category_name' => 'Electronic',  'category_slug' => 'electronic', 'created_at' => Carbon::now()->toDateTimeString()],
            [ 'category_name' => 'Fashion', 'category_slug' => 'fashion', 'created_at' => Carbon::now()->toDateTimeString()],
        ]);
    }
}
