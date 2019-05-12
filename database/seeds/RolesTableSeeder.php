<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'          =>'Administrator',
            'slug'          =>'admin',
            'description'   =>'Administrator role',
            'special'       =>'all-access'
        ]);
        Role::create([
            'name'          =>'Project leader',
            'slug'          =>'leader',
            'description'   =>'Leader role',
            'special'       =>'no-access'
        ]);
        Role::create([
            'name'          =>'Researcher',
            'slug'          =>'researcher',
            'description'   =>'Researcher role',
            'special'       =>'no-access'
        ]);
    }
}
