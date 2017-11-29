<?php namespace App\Http\Controllers;

use App\Categories;
use App\Posts;
use App\Http\Requests;

class RssController extends Controller
{

    public function index($type)
    {
        if($type=='sitemap'){
            $posts= Posts::approve('yes')->orderBy('published_at', 'desc')->limit(20)->get();
            $categories = Categories::get();

            return  response()->view('vendor.sitemap', compact('posts', 'categories'))->header('Content-Type', 'xml');

        }

         $posts = $this->getdata($type);
        if(count($posts) == 0){
            \Session::flash('error.message',  trans('index.emptyplace'));
            return redirect()->back();
        }

        return  response()->view('vendor.rss', compact('posts'))->header('Content-Type', 'text/xml');
    }


    public function getdata($type)
    {
        if($type=='index'){

            $posts= Posts::approve('yes')->latest("published_at")->limit(20)->get();

        }elseif($type=='news' or $type=='lists' or $type=='quizzes' or $type=='videos' or $type=='polls'){

            if($type == 'news'){
                $t = 'news';
            }elseif($type == 'lists'){
                $t = 'list';
            }elseif($type == 'quizzes'){
                $t = 'quiz';
            }elseif($type == 'videos'){
                $t = 'video';
            }elseif($type == 'polls'){
                $t = 'poll';
            }
            $posts = Posts::byType($t)
                ->approve('yes')
                ->latest("published_at")
                ->take(20)->get();

        }else{
            $category = Categories::where("name_slug", $type)->first();

            if(!$category){
                abort('404');
            }

            $posts = Posts::select('posts.*')

                ->leftJoin('categories', function($leftJoin){
                    $leftJoin->on('categories.id', '=', 'posts.category_id');
                })
                ->where('categories.name_slug', '=',  $type)
                ->latest("published_at")->approve('yes')->take(20)->get();
            return $posts;
        }


        return $posts;
    }

    public function json($type)
    {

        sleep(1);
        if($type=='news' or $type=='list' or $type=='quiz' or $type=='video' or $type=='poll'){

            $posts = Posts::byType($type)
                ->approve('yes')
                ->latest("published_at")
                ->take(6)->get();

        }else{

            $category = Categories::where("name_slug", $type)->first();

            if(!$category){
                abort('404');
            }

            $posts = Posts::where('category_id',  $category->id)->approve('yes')
                    ->latest("published_at")->take(6)->get();

        }

        if(count($posts) == 0){
            return response()->json("");
        }
        foreach($posts as $key => $post){
            $postsre[] = array('slug' => makeposturl($post),'title' => $post->title, 'thumb' =>  makepreview($post->thumb, 's', 'posts'));
        }

        return response()->json($postsre);
    }




}
