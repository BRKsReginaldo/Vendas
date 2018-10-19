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
        $user = \App\User::create([
            'name' => 'Reginaldo Junior',
            'email' => 'reginaldo.junior696@gmail.com',
            'password' => bcrypt(env('ADMIN_PASSWORD', '123456')),
            'email_verified_at' => now()
        ]);

        $user->assignRole('admin');
    }
}
