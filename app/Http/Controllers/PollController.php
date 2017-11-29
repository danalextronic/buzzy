<?php

namespace App\Http\Controllers;

use App\PollVotes;
use App\Posts;
use App\Reactions;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class PollController extends Controller
{
    public function __construct(){

            parent::__construct();

//        $this->middleware('auth');
//
    }


    public function VoteAPoll($catname, $slug,  Request $request){

        $post = Posts::where('type', $catname)->where('slug', $slug)->first();

        $entrys = $post->entry;

        $voteid = $request->query('vote');

        if(PollVotes::currentUserHasVoteOnPost($post->id)->get()->isEmpty()){

            $vote = new PollVotes;
           $vote->post_id = $post->id;
           $vote->option_id = $voteid;
            $vote->user_id = Auth::check()? Auth::user()->id : null;
           $vote->save();


            if($request->ajax()){
               return view('_particles._lists.entryslists', compact("post", "entrys"));
            }
        };


        return "true";

    }
    public function VoteReaction($catname, $slug,  Request $request){

        $post = Posts::where('type', $catname)->where('slug', $slug)->first();

        $voteid = $request->query('reaction');

        if(Reactions::currentUserHasVoteOnPost($post->id)->get()->isEmpty()){

            $reactions = new Reactions;
            $reactions->post_id = $post->id;
            $reactions->reaction_type = $voteid;
            $reactions->user_id = Auth::user()->id;
            $reactions->save();

            $reactions = $post->reactions;

            if($request->ajax()){

                return view('_forms._reactionforms', compact("reactions", "post"));

            }

        };


        return true;

    }

}
