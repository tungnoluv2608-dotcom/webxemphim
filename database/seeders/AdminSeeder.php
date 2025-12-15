<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Tạo tài khoản admin DUY NHẤT
        User::create([
            'name' => 'Admin',
            'email' => 'admin123@gmail.com', // Email admin của bạn
            'password' => Hash::make('123456'), // Đổi password mạnh
            'is_admin' => true
        ]);
        
        echo "Tài khoản admin đã được tạo!\n";
        echo "Email: admin123@gmail.com\n";
        echo "Password: 123456\n";
    }
}