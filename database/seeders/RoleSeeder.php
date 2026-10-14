<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'Администратор']);
        Role::create(['name' => 'Журналист']);
        Role::create(['name' => 'Читатель']);
    }
}