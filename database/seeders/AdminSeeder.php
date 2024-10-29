<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => 1
            
        
       
    ]);
    User::factory()->create([
        
        'name' => 'Student',
        'email' => 'student@mail.com',
        'password' => bcrypt('student'),
        'role_id' => 2
    
   
]);
    }
}
