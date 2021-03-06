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

        $users = factory(Users::class, 50)->create()->each(function ($user) use ($subscriberRole, $userRole) {
            $data = [
                'user_id' => $userId = $user->id,
                'code' => $this->generateRandomString(32),
                'completed' => 1,
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            DB::table('activations')->insert($data);

            if ($user->id == 3) {
                $subscriberRole->users()->attach($user);
            } else {
                $userRole->users()->attach($user);
            }
        });
    }

    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
