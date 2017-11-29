<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Pages;
use App\Posts;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    public function __construct(){

        parent::__construct();

    }
    /**
     * Show news/lists category
     *
     * @return \Illuminate\View\View
     */
    public function posttype(Request $request){

        $cat = $request->segment('1');
        if($cat == 'news'){
            $t = 'news';
            $title = trans('index.news');
            $description = "";
        }elseif($cat == 'lists'){
            $t = 'list';
            $title = trans('index.lists');
            $description = "";
        }elseif($cat == 'quizzes'){
            $t = 'quiz';
            $title = trans('buzzyquiz.quizzes');
            $description = "";
        }elseif($cat == 'videos'){
            $t = 'video';
            $title = trans('index.videos');
            $description = "";
        }elseif($cat == 'polls'){
            $t = 'poll';
            $title = trans('index.polls');
            $description = "";
        }else{
            $t = 'all';
            $title = trans('index.posts');
            $description = "";
        }

        $lastItems = Posts::byType($t)->typesActivete()
                            ->approve('yes')
                            ->latest("published_at")
                            ->paginate(15);

        $typeo = $t;

        if($request->query('page')){
            
            $lastFeatures=$lastItems;
            if($request->ajax()){
                return view('pages.catpostloadpage', compact('lastItems','lastFeatures'));
            }else{
                return redirect('/');
            }

        }

        $lastNews = Posts::approve('yes')->typesActivete()->byType($t)->getStats('seven_days_stats', 'DESC', 7)->get();

        //top Features
        $lastFeaturestop = Posts::approve('yes')->typesActivete()->byType($t)->where("featured_at", '>', '')->latest("featured_at")->take(4)->get();

        return view('pages.showcategory', compact("lastFeaturestop","lastItems", "lastNews", "title",  "description", "typeo"));

    }


    /**
     * Show search page
     *
     * @param Request $req
     * @return \BladeView|bool|\Illuminate\View\View
     */
    public function search(Request $req){

        $q = $req->query('q');

        $lastItems = Posts::where("title", "LIKE", "%$q%")
            ->approve('yes')

            ->latest("published_at")
            ->paginate(10);

        $title = 'POSTS';
        $description = "";
        $search = trans('updates.searchfor', ['word' => $q]);

        $lastNews = Posts::approve('yes')->typesActivete()->getStats('thirty_days_stats', 'DESC', 7)->get();

        if($req->query('page')){
            $lastFeatures=$lastNews;
            if($req->ajax()){
                return view('pages.catpostloadpage', compact('lastItems','lastFeatures'));
            }else{
                return redirect('/');
            }
        }

        return view('pages.showcategory', compact("lastItems","lastNews","title","description","search"));
    }



    /**
     * Show child categories
     *
     * @param $catname
     * @param Request $req
     * @return \BladeView|bool|\Illuminate\View\View
     */
    public function showCategory($catname, Request $request)
    {
        $this->cat= $catname;

        $category = Categories::where("name_slug", $catname)->first();

        if(!$category){
            abort('404');
        }


        $lastItems = Posts::select('posts.*')

            ->leftJoin('categories', function($leftJoin){
                $leftJoin->on('categories.id', '=', 'posts.category_id');
            })
            ->typesActivete()
            ->where('categories.name_slug', '=',  $catname)->typesActivete()
            ->latest("published_at")->approve('yes')->paginate(15);

        $title = $category->name;
        $description = $category->description;
        $typeo = $category->type;

        $lastNews = Posts::approve('yes')->typesActivete()->where('category_id', $category->id)->getStats('seven_days_stats', 'DESC', 7)->get();

        if($request->query('page')){
            $lastFeatures=$lastNews;
            if($request->ajax()){
                return view('pages.catpostloadpage', compact('lastItems','lastFeatures'));
            }else{
                return redirect('/');
            }
        }


        return view("pages.showcategory", compact("lastItems", "lastNews", "title","description", "typeo"));
    }

    /**
     * Show Pages
     *
     * @param $catname
     * @param Request $req
     * @return \BladeView|bool|\Illuminate\View\View
     */
    public function showpage($catname, Request $req)
    {

        $page = Pages::where("slug", $catname)->first();

        if(!$page){
            abort('404');
        }

        return view("pages.showpage", compact("page"));
    }

}
