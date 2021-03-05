<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetLikesContriller extends Controller
{
    public function store(Tweet $tweet){

        if($tweet->isLikedBy(auth()->user())){
            $tweet->unlike();
            return back();
        }

        $tweet->like(auth()->user());
        return back();
    }

    public function destroy(Tweet $tweet){

        if($tweet->isDislikedBy(auth()->user())){
            $tweet->unlike();
            return back();
        }

        $tweet->dislike(auth()->user());
        return back();
    }
}
