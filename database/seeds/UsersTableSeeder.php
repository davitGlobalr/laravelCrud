<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@test.loc',
                'password'       => '$2y$10$tySIrWuYcOjZmQQ6WOERu.wk1JOmOIiQ5TboOs0eijrTA/nJ1DDzG',
                'remember_token' => null,
                'created_at'     => '2020-03-07 17:53:12',
                'updated_at'     => '2020-03-07 17:53:12',
            ],
        ];

        User::insert($users);

        $users = factory(App\User::class, 15)->create();

    }
}
