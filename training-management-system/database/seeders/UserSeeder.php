<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'username' => 'admin',
    'name' => 'Administrator',
    'email' => 'admin@gmail.com',
    'password' => Hash::make('adminnimda'),
    'phone_number' => '08123456789',
    'company' => 'AdminCorp.',
    'role' => 'admin',
    'birthday' => '2022-06-22',
]);

User::create([
    'username' => 'guest',
    'name' => 'Guest user',
    'email' => 'guest@gmail.com',
    'password' => Hash::make('guesttseug'),
    'phone_number' => '0987654321',
    'company' => 'GuestCorp.',
    'role' => 'guest',
    'birthday' => '2002-02-02',
]);