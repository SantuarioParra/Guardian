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
            $u->assignRole(Role::where('slug','researcher')->value('id'));
        });
        factory(App\User::class,5)->create()->each(function ($u){
            $u->assignRole(Role::where('slug','leader')->value('id'));
        });

        $user = new User();
        $user->name = "Luis Fernando";
        $user->email = "santuarioparral@hotmail.com";
        $user->password =  Hash::make('root');
        $user->save();
        $user->assignRole(Role::where('slug','admin')->value('id'));

        $user = new User();
        $user->name = "Antonio";
        $user->email = "a@hotmail.com";
        $user->password =  Hash::make('root');
        $user->save();
        $user->assignRole(Role::where('slug','researcher')->value('id'));

        $user = new User();
        $user->name = "Bob";
        $user->email = "b@hotmail.com";
        $user->password =  Hash::make('root');
        $user->save();
        $user->assignRole(Role::where('slug','researcher')->value('id'));
        $user = new User();

        $user->name = "Cesar";
        $user->email = "c@hotmail.com";
        $user->password =  Hash::make('root');
        $user->save();
        $user->assignRole(Role::where('slug','researcher')->value('id'));
        $user = new User();

        $user->name = "Denis";
        $user->email = "d@hotmail.com";
        $user->password =  Hash::make('root');
        $user->save();
        $user->assignRole(Role::where('slug','researcher')->value('id'));
        $user = new User();

        $user->name = "Edgar";
        $user->email = "e@hotmail.com";
        $user->password =  Hash::make('root');
        $user->save();
        $user->assignRole(Role::where('slug','researcher')->value('id'));
    }
}
