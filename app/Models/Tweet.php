<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Tweet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function like($user = null){
        return $this->likes()->updateOrCreate(
            ['user_id' => $user ? $user->id : auth()->id()],
            ['liked' => true]);
    }

    public function dislike($user = null){
        return $this->likes()->updateOrCreate(
            ['user_id' => $user ? $user->id : auth()->id()],
            ['liked' => false]);
    }

    public function isLikedBy(User $user){
        return (bool) $user->likes->where('user_id',$user->id)->where('liked',true)->count();
    }

    public function isDislikedBy(User $user){
        return (bool) $user->likes->where('user_id',$user->id)->where('liked',false)->count();
    }

    public function scopeWithLikes(Builder $query){
        $query->leftJoinSub(
            'select tweet_id, sum(liked) likes, sum(!liked) dislikes from likes group by tweet_id',
            'likes',
            'likes.tweet_id',
            'tweets.id'
        );
    }
}
