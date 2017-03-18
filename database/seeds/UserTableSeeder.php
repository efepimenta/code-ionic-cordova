<?php

use CodeDelivery\Models\Client;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\CodeDelivery\Models\User::class)->create(
            [
                'name' => 'Usuario normal',
                'email' => 'user@email.com',
                'password' => bcrypt('123456'),
                'remember_token' => str_random(10)
            ]
        )->client()->save(factory(Client::class)->make());

        factory(\CodeDelivery\Models\User::class)->create(
            [
                'name' => 'Usuario Delivery',
                'email' => 'delivery@email.com',
                'password' => bcrypt('123456'),
                'remember_token' => str_random(10)
            ]
        )->client()->save(factory(Client::class)->make());

        factory(\CodeDelivery\Models\User::class)->create(
            [
                'name' => 'Usuario admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('123456'),
                'role' => 'admin',
                'remember_token' => str_random(10)
            ]
        )->client()->save(factory(Client::class)->make());;

        factory(\CodeDelivery\Models\User::class, 3)->create(
            [
                'role' => 'deliveryman',
            ]
        );

        factory(\CodeDelivery\Models\User::class, 10)->create()->each(function ($u) {
            $u->client()->save(factory(Client::class)->make());
        });
    }
}
