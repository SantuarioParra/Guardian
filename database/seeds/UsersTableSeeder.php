<?php

use Illuminate\Database\Seeder;
use App\User;
use Caffeinated\Shinobi\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,20)->create()->each(function ($u){
            $u->assignRole(Role::where('name','researcher')->value('id'));
        });
        factory(App\User::class,5)->create()->each(function ($u){
            $u->assignRole(Role::where('name','leader')->value('id'));
        });

        $user = new User();
        $user->name = "Luis Fernando";
        $user->email = "santuarioparral@hotmail.com";
        $user->password =  Hash::make('root');
        $user->save();
    }
}
