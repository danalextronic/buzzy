<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reactions extends Model
{
    protected $table = 'reactions';

    protected $fillable = [ 'post_id', 'user_id', 'reaction_type'];

    public function scopeVoteOnPost($query)
    {
        if(!Auth::check()){
            return false;
        }

        return $query->where('user_id', Auth::user()->id);
    }

    public function scopeCurrentUserHasVoteOnPost($query, $post)
    {
        if(!Auth::check()){
            return NULL;
        }

        return $query->where('user_id', Auth::user()->id)->where('post_id', $post);
    }
}
