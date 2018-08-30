<?php

use Illuminate\Database\Seeder;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

class SentinelDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Users
        DB::table('users')->truncate();

        $admin = Sentinel::getUserRepository()->create(array(
            'username' => 'admin',
            'email'    => 'admin@admin.com',
            'password' => '12345678',
            'first_name' => 'System',
            'last_name' => 'Admin',
            'address' => '125 Luong The Vinh street, Ha Noi, Viet Nam',
            'phone' => '0936200593',
            'birthday' => '1993-05-20',
        ));

        $mod = Sentinel::getUserRepository()->create(array(
            'username' => 'moderator',
            'email'    => 'moderator@mod.com',
            'password' => '12345678',
            'first_name' => 'Testing',
            'last_name' => 'Mod',
            'address' => '125 Luong The Vinh street, Ha Noi, Viet Nam',
            'phone' => '0936200593',
            'birthday' => '1993-05-20',
        ));

        // Create Activations
        DB::table('activations')->truncate();
        $code = Activation::create($admin)->code;
        Activation::complete($admin, $code);
        $code = Activation::create($mod)->code;
        Activation::complete($mod, $code);

        // Create Roles
        DB::table('roles')->truncate();
        DB::table('role_users')->truncate();
        $administratorRole = Sentinel::getRoleRepository()->create(array(
            'name' => 'Administrator',
            'slug' => 'administrator',
            'permissions' => array(
                'users.create' => true,
                'users.update' => true,
                'users.view' => true,
                'users.destroy' => true,
                'roles.create' => true,
                'roles.update' => true,
                'roles.view' => true,
                'roles.delete' => true
            )
        ));

        $moderatorRole = Sentinel::getRoleRepository()->create(array(
            'name' => 'Moderator',
            'slug' => 'moderator',
            'permissions' => array(
                'users.update' => true,
                'users.view' => true,
            )
        ));

        $subscriberRole = Sentinel::getRoleRepository()->create(array(
            'name' => 'Subscriber',
            'slug' => 'subscriber',
            'permissions' => array()
        ));

        $userRole = Sentinel::getRoleRepository()->create(array(
            'name' => 'User',
            'slug' => 'user',
            'permissions' => array()
        ));

        // Assign Roles to Users
        $administratorRole->users()->attach($admin);
        $moderatorRole->users()->attach($mod);
//        $subscriberRole->users()->attach($user);

        $users = factory(Users::class, 50)->create()->each(function ($user) use ($userRole) {
//            $code = Activation::create($user)->code;
//            Activation::complete($user, $code);
            $userRole->users()->attach($user);
        });


    }
}
