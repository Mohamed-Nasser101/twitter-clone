<?php

namespace Database\Seeders;

use App\Models\Like;
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
        User::factory(20)->create();

        Tweet::factory(200)->create();

        for($i = 0 ;$i < 500 ; $i++){
            $user = User::inRandomOrder()->first();
            $tweet = Tweet::inRandomOrder()->first();
            $liked = [true,false];
            $rand = rand(0,1);

            if($tweet->isLikedBy($user) || $tweet->isDislikedBy($user) ){ continue; }

            $user->likes()->create([
                'tweet_id' => $tweet->id,
                'liked' => $liked[$rand],
            ]);
        }


        for($i = 0 ;$i < 300 ; $i++){
            $user1 = User::inRandomOrder()->first();
            $user2 = User::inRandomOrder()->first();

            $user1->toggleFollow($user2);
        }
    }
}
