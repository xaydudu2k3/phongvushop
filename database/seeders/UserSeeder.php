<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
              'name' => 'Nguyễn Văn Minh Quân',
              'usertype_id' => 1,
              'gender' => 1,
              'cccd' => '056201009724',
              'phone' => '0987654321',
              'email' => 'admin@localhost.com',
              'thumb' => '/storage/uploads/admin/avatar.jpg',
              'email_verified_at' => now(),
              'password' => Hash::make('123456'),
            ]
          ]);
    }
}
