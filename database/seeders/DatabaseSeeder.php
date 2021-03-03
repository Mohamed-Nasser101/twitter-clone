<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tweet;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' =>'mohamed',
            'username' =>'me',
            'email' =>'m@m.com'
        ]);
        User::factory(10)->create();


        Tweet::factory(5)->create([
            'user_id' => 1
        ]);

        Tweet::factory(50)->create();

        User::find(1)->follow(User::find(2));
        User::find(1)->follow(User::find(3));
        User::find(1)->follow(User::find(4));
        User::find(1)->follow(User::find(5));
        User::find(1)->follow(User::find(6));
        User::find(1)->follow(User::find(7));
        User::find(1)->follow(User::find(8));
        User::find(1)->follow(User::find(9));

        User::find(2)->follow(User::find(1));
        User::find(2)->follow(User::find(3));
        User::find(2)->follow(User::find(4));
        User::find(2)->follow(User::find(5));
        User::find(2)->follow(User::find(6));
        User::find(2)->follow(User::find(7));
        User::find(2)->follow(User::find(8));
        User::find(2)->follow(User::find(9));

        User::find(3)->follow(User::find(1));
        User::find(3)->follow(User::find(2));
        User::find(3)->follow(User::find(4));
        User::find(3)->follow(User::find(5));
        User::find(3)->follow(User::find(6));
        User::find(3)->follow(User::find(7));
        User::find(3)->follow(User::find(8));
        User::find(3)->follow(User::find(9));


        User::find(4)->follow(User::find(1));
        User::find(4)->follow(User::find(2));
        User::find(4)->follow(User::find(3));
        User::find(4)->follow(User::find(5));
        User::find(4)->follow(User::find(6));
        User::find(4)->follow(User::find(7));
        User::find(4)->follow(User::find(8));
        User::find(4)->follow(User::find(9));
    }
}
