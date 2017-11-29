<?php

namespace App\Http\Controllers\Admin;

use App\Events\PostUpdated;
use Carbon\Carbon;
use App\Posts;
use yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostsController extends MainAdminController
{

    public function __construct()
    {

        $this->middleware('DemoAdmin', ['only' => ['approvepost', 'showhomepage', 'pickfeatured', 'sendtrashpost', 'forcetrashpost']]);

        parent::__construct();

    }

    
    public function features(){

        return view('_admin.pages.posts')->with(['title' => 'Features Posts', 'desc' => '', 'type' => 'features']);

    }
    public function unapprove(){

        return view('_admin.pages.posts')->with(['title' => 'Posts', 'desc' => '', 'type' => 'all']);

    }
    public function all(){

        return view('_admin.pages.posts')->with(['title' => 'All Posts', 'desc' => '', 'type' => 'all']);

    }
    public function news(){

        return view('_admin.pages.posts')->with(['title' => 'News', 'desc' => 'All news', 'type' => 'news']);

    }
    public function lists(){

        return view('_admin.pages.posts')->with(['title' => 'Lists', 'desc' => 'All lists', 'type' => 'lists']);

    }
    public function quizzes(){

        return view('_admin.pages.posts')->with(['title' => 'Quizzes', 'desc' => 'All quizzes', 'type' => 'quiz']);

    }
    public function videos(){
        return view('_admin.pages.posts')->with(['title' => 'Videos', 'desc' => 'All videos', 'type' => 'videos']);
    }
    public function polls(){
        return view('_admin.pages.posts')->with(['title' => 'Polls', 'desc' => 'All polls', 'type' => 'polls']);
    }


    public function approvepost($id)
    {

        $post = Posts::findOrFail($id);

        if($post->approve == 'no'){
            $post->approve = 'yes';
            $post->save();

            try{
                event(new PostUpdated($post, 'Approved'));
            }catch(\Exception $e){

            }


        }else{
            $post->approve = 'no';
            $post->save();

        }

        \Session::flash('success.message', 'Approved');

        return redirect()->back();

    }

    public function showhomepage($id)
    {

        $post = Posts::findOrFail($id);

        if($post->show_in_homepage == null){

            $post->show_in_homepage = 'yes';

        }else{
            $post->show_in_homepage = null;
        }

        $post->save();

        \Session::flash('success.message', 'Done');

        return redirect()->back();

    }

    public function pickfeatured($id)
    {

        $post = Posts::findOrFail($id);

        if($post->featured_at == null){

            $post->featured_at = Carbon::now();

        }else{
            $post->featured_at = null;
        }

        $post->save();

        \Session::flash('success.message', 'Done');

        return redirect()->back();

    }

    public function sendtrashpost($id)
    {
        $post = Posts::withTrashed()->findOrFail($id);

        if($post->deleted_at == null){
            $post->approve = 'no';
            $post->delete();
        }else{
            $post->approve = 'yes';
            $post->restore();
        }

        try{
            event(new PostUpdated($post, 'Trash'));

        }catch(Exception $e){

        }



        \Session::flash('success.message', 'Moved to Trash');

        return redirect()->back();

    }

    public function forcetrashpost($id)
    {

        $post = Posts::withTrashed()->where('id', $id)->first();

        foreach($post->entry as $entr){

            if($entr->type=='image'){

                \File::delete(public_path() .'/upload/media/entries/'.$entr->image);

            }
            $entr->forceDelete(); //del entry
        }

        \File::delete(public_path() .'/upload/media/posts/'.$post->thumb.'-b.jpg');
        \File::delete(public_path() .'/upload/media/posts/'.$post->thumb.'-s.jpg');

        $post->forceDelete();

        \Session::flash('success.message', 'Deleted permanently');

        return redirect()->back();

    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getdata(Request $request)
    {

        $typew = $request->query('type');

        if($typew=='lists'){
            $type='list';
        }elseif($typew=='quiz'){
            $type='quiz';
        }elseif($typew=='polls'){
            $type='poll';
        }elseif($typew=='videos'){
            $type='video';
        }else{
            $type='news';
        }


        $only = $request->query('only');


        $post = Posts::leftJoin('users', 'posts.user_id', '=', 'users.id');
        $post->select('posts.*');

        if (Auth::user()->usertype == 'Staff') {
            $User = Auth::user();
            $post->whereIn('domain_id', $User->domains->lists('id')->toArray())->get();
        }
        
        if($typew == 'all'){
//not set
        }elseif($typew !== 'features'){
            $post->where('type', $type);
        }else{
            $post->where("featured_at", '>', '');
        }

        if($only=='deleted'){
            $post->onlyTrashed();
        }else{
            $post->where('deleted_at', null);
        }


        if($only=='unapprove'){
            $post->where('approve', 'no');
        }

        return Datatables::of($post)

            ->editColumn('thumb', function ($post) {


                return '<img src="'.makepreview($post->thumb, 's', 'posts') .'" width="125">';
            })


            ->editColumn('title', function ($post) {


                $fsdfd = '<a href="'.makeposturl($post).'" target=_blank style="font-size:16px;font-weight: 600">
                                    '.$post->title.'
                                     </a>

                                    <div class="product-meta">

                                    </div>
                                    ';


                return $fsdfd;
            })
            ->editColumn('user', function ($post) {


                $fsdfd = '   <div  style="font-weight: 400;color:#aaa">
                                        <a href="/profile/'.$post->user->username_slug.'" target="_blank"><img src="'.makepreview($post->user->icon, 's', 'members/avatar').'" width="32" style="margin-right:6px">'.$post->user->username.'</a>
                                    </div>
                                   ';


                return $fsdfd;
            })


            ->addColumn('approve', function ($post){

                if($post->deleted_at!==null) {

                    $fsdfd = '<div class="label label-danger">On Trash</div>';

                }elseif($post->approve=='draft') {

                    $fsdfd = '<div class="label label-info" style="background-color: #9c486c !important;">Draft Post</div>';

                }elseif($post->approve=='no') {

                    $fsdfd = '<div class="label label-info" style="background-color: #9c6a11 !important;">Awaiting Approval</div>';

                }elseif($post->featured_at !== null) {

                    $fsdfd =  '<div class="clear"></div><div class="label label-warning" style="background-color: #9C5D54 !important;">Featured Post</div>';

                }elseif($post->approve=='yes') {

                    $fsdfd = '<div class="label label-info">Active</div>';

                }

                if($post->show_in_homepage=='yes') {

                    $fsdfd = $fsdfd. '<div class="clear"></div><div class="label label-success">Picked for homepage</div>';
                }


                return $fsdfd;
            })


            ->addColumn('action', function ($post) {


                 $edion= '<div class="input-group-btn">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Actions <span class="fa fa-caret-down"></span></button>
                                  <ul class="dropdown-menu pull-left" style="left:-100px;  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);">';

             if($post->deleted_at==null) {


                if($post->approve=='no') {

                    $edion= $edion . '<li><a href="'.action("Admin\PostsController@approvepost",  $post->id).'"><i class="fa fa-check"></i>  Approve</a></li>';

                }elseif($post->approve=='yes') {

                    $edion= $edion . '<li><a href="'.action("Admin\PostsController@approvepost",  $post->id).'"><i class="fa fa-remove"></i> Undo Approve/</a></li>';


                }

                if($post->featured_at == null) {

                    $edion= $edion .  '<li><a href="'.action("Admin\PostsController@pickfeatured",  $post->id).'"><i class="fa fa-star"></i> Pick for Featured</a></li>';

                }else{

                    $edion= $edion .  '<li><a href="'.action("Admin\PostsController@pickfeatured",  $post->id).'"><i class="fa fa-remove"></i> Undo Featured</a></li>';

                }

                if($post->show_in_homepage==null) {

                    $edion= $edion .  '<li><a href="'.action("Admin\PostsController@showhomepage",  $post->id).'"><i class="fa fa-dashboard"></i> Pick for Homepage</a></li>';

                }elseif($post->show_in_homepage=='yes') {

                    $edion= $edion .  '<li><a href="'.action("Admin\PostsController@showhomepage",  $post->id).'"><i class="fa fa-remove"></i>  Undo from Homepage</a></li>';

                }

                 $edion= $edion .  '<li class="divider"></li>';

                 $edion= $edion .  '<li><a target="_blank" href="/edit/'.$post->id.'"><i class="fa fa-edit"></i> Edit Post</a></li>';

                 $edion= $edion .  '<li class="divider"></li>';

                }

                if($post->deleted_at==null) {

                    $edion= $edion . '<li><a class="sendtrash" href="'.action("Admin\PostsController@sendtrashpost",  $post->id).'"><i class="fa fa-trash"></i> Send to Trash</a></li>';

                }else{

                    $edion= $edion . '<li><a href="'.action("Admin\PostsController@sendtrashpost",  $post->id).'"><i class="fa fa-trash"></i> Retrieve from Trash</a></li>';

                }

                 $edion= $edion .  '<li><a class="permanently" href="'.action("Admin\PostsController@forcetrashpost",  $post->id).'"><i class="fa fa-remove"></i> Delete permanently</a></li>';

                 $edion = $edion .  '</ul>
                            </div>';


                return $edion;
            })



            ->make(true);

    }



}
