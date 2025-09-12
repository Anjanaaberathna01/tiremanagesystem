<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'full_name' => 'Mr. Admin',
                'email' => 'admin@gmail.com',
                'phone_number' => '0761180205',
                'address' => '143/20,Ranathunaga road,Udugampala',
                'image' => 'profile_images/l0SIl4udpmy8BjhwvdPlkqOO4dw8bpglQxzNEfiT.jpg',
                'username' => 'admin@123',
                'password' => '$2y$12$qu/13kxaJ.WKn1eARtS4QO8Pwd9kAQf2pgBLkLz9hO70Sh57BroJ.', 
                'role' => 'admin',
                'department' => 'HR Deparment',
                'created_at' => '2025-07-07 17:39:42',
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Mr. Kamal',
                'email' => 'Kamal@gmail.com',
                'phone_number' => '076495581',
                'address' => '23/40,kadavath',
                'image' => null,
                'username' => 'driver@123',
                'password' => '$2y$12$qu/13kxaJ.WKn1eARtS4QO8Pwd9kAQf2pgBLkLz9hO70Sh57BroJ.', // already hashed
                'role' => 'user',
                'department' => 'Transport',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Mr. Supervisor',
                'email' => 'supervisor@gmail.com',
                'phone_number' => '0762345608',
                'address' => '123/20',
                'image' => null,
                'username' => 'supervisor@123',
                'password' => '$2y$12$qu/13kxaJ.WKn1eARtS4QO8Pwd9kAQf2pgBLkLz9hO70Sh57BroJ.',
                'role' => 'supervisor',
                'department' => 'Digital Platform',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Mr. Nadun',
                'email' => 'nadun@gmail.com',
                'phone_number' => '12345',
                'address' => 'dcsfedbvr',
                'image' => null,
                'username' => 'mechanic@123',
                'password' => '$2y$12$qu/13kxaJ.WKn1eARtS4QO8Pwd9kAQf2pgBLkLz9hO70Sh57BroJ.',
                'role' => 'mechanic',
                'department' => 'Transport',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Mr. Transport Officer',
                'email' => 'transport@gmail.com',
                'phone_number' => '1234567891',
                'address' => '132/20',
                'image' => 'profile_images/r8y5UMZe5TNVWBFuzYW0Wb5SsFGNrZCbRnUlGKEP.jpg',
                'username' => 'transport@123',
                'password' => '$2y$12$qu/13kxaJ.WKn1eARtS4QO8Pwd9kAQf2pgBLkLz9hO70Sh57BroJ.',
                'role' => 'transport_officer',
                'department' => 'transport department',
                'created_at' => '2025-07-02 07:35:36',
                'updated_at' => now(),
            ],
        ]);
    }
}
