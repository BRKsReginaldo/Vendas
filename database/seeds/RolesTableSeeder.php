<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(config('auth.roles') as $name => $formalName) {
            if (\App\Role::where('name', $name)->exists()) continue;
            \App\Role::create([
               'name' => $name,
               'formal_name' => $formalName
            ]);
        }
    }
}
