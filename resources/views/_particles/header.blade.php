<header id="header" class="header">

    <div class="container">
        <div class="header__logo">
            <a href="{{url('/profile/admin/options')}}" title="">
                <p>Create Content People Love</p>
            </a>
        </div>
        <div class="header__nav">
            <div class="coltrigger pull-l">
                <a href="{{url('/profile/admin/options')}}" id="menu-toggler">
                    <i class="fa fa-align-justify"></i>
                </a>
            </div>
            <!--div id="colnav" class="toggle-nav pull-l" style="position: relative">
                <ul class="navmenu">
                @if($DB_PLUGIN_NEWS == 'on')<li class=" @if(Request::segment(1)=='news') active @endif" ><a href="{{ url('news') }}">{{ trans('index.news') }}</a></li>@endif
                @if($DB_PLUGIN_LISTS == 'on')<li @if(Request::segment(1)=='lists' or Request::segment(1)=='list') class="active" @endif><a href="{{ url('lists') }}">{{ trans('index.lists') }}</a></li>@endif
                @if($DB_PLUGIN_QUIZS == 'on') <li @if(Request::segment(1)=='quizzes' or Request::segment(1)=='quiz') class="active" @endif>
                    <a href="{{ url('quizzes') }}">{{ trans('buzzyquiz.quizzes') }}</a>
                </li>@endif
                @if($DB_PLUGIN_POLLS == 'on')<li @if(Request::segment(1)=='polls' or Request::segment(1)=='poll') class="active" @endif>
                    <a href="{{ url('polls') }}">{{ trans('index.polls') }}</a>
                </li>@endif
                @if($DB_PLUGIN_VIDEOS == 'on')<li @if(Request::segment(1)=='videos' or Request::segment(1)=='video') class="active" @endif>
                    <a href="{{ url('videos') }}">{{ trans('index.videos') }}</a>
                </li>@endif
                <li class="cats_link">
                    <a  href="javascript:">{{ trans('index.sections') }} <i class="fa fa-caret-down"></i></a>
                </li>
            </ul>

                <div class="search_link">
                    <div class="searchbox_container">
                        <form method="get" action="/search" >
                            <input type="text" name="q" id="searchbox_text" placeholder="{{ trans('index.search') }}">
                        </form>
                    </div>
                    <a id="searchbutton" href="javascript:"><i class="fa fa-search"></i></a>
                    <a id="searchclosebutton" href="javascript:"><i class="fa fa-close"></i></a>
                </div>
            </div-->
        </div>
        <div class="header__usernav">

            <!--div class="create-links hor">
                <a class="button button-rosy" href="{{ action('PostsController@CreateNew', ['new'=>'list']) }}"><i class="fa fa-plus-circle"></i><b>{{ trans('index.create') }}</b></a>
                <ul class="sub-nav ">
                    @if($DB_PLUGIN_NEWS == 'on')<li>
                        <a href="{{ action('PostsController@CreateNew') }}" class="sub-item"><i class="fa fa-file-text"></i> {{ trans('index.new', ['type' => trans('index.new-s') ]) }}</a>
                    </li>@endif
                    @if($DB_PLUGIN_LISTS == 'on')<li>
                        <a href="{{ action('PostsController@CreateNew', ['new'=>'list']) }}" class="sub-item"><i class="fa fa-th-list"></i> {{ trans('index.new', ['type' => trans('index.list') ]) }}</a>
                    </li>@endif
                    @if($DB_PLUGIN_QUIZS == 'on') <li>
                        <a href="{{ action('PostsController@CreateNew', ['new'=>'quiz']) }}" class="sub-item"><i class="fa fa-question-circle"></i> {{ trans('index.new', ['type' => trans('buzzyquiz.quiz') ]) }}</a>
                    </li>@endif
                    @if($DB_PLUGIN_POLLS == 'on')<li>
                        <a href="{{ action('PostsController@CreateNew', ['new'=>'poll']) }}" class="sub-item"><i class="fa fa-check-square-o"></i> {{ trans('index.new', ['type' => trans('index.poll') ]) }}</a>
                    </li>@endif
                    @if($DB_PLUGIN_VIDEOS == 'on')<li>
                        <a href="{{ action('PostsController@CreateNew', ['new'=>'video']) }}" class="sub-item"><i class="fa fa-youtube-play"></i> {{ trans('index.new', ['type' => trans('index.video') ]) }}</a>
                    </li>@endif
                </ul>
            </div-->
            <ul class="navmenu">
            @if(Auth::check())
                <li class="profile-info hor pull-r">
                    <a href="javascript:;" class="user-profile">
                        <img src="{{ makepreview(Auth::user()->icon, 's', 'members/avatar') }}" width="32" height="32"  alt="{{ Auth::user()->username }}">
                        <span class="name"><i class="fa fa-caret-down"></i> <strong class="namegp">{{ Auth::user()->username }}</strong></span>
                    </a>
                    <ul class="sub-nav">
                        <li>
                            <a class="sub-item" href="{{ action('UsersController@index', [ Auth::user()->username_slug ]) }}">{{ trans('index.myprofile') }}</a>
                        </li>
                        <li>
                            <a class="sub-item" href="{{ action('UsersController@followfeed', ['id' => Auth::user()->username_slug ]) }}">{{ trans('updates.feedposts') }}</a>
                        </li>
                        <li>
                            <a class="sub-item" href="{{ action('UsersController@draftposts', ['id' => Auth::user()->username_slug ]) }}">{{ trans('index.draft') }}</a>
                        </li>
                        <li>
                            <a class="sub-item" href="{{ action('UsersController@deletedposts', ['id' => Auth::user()->username_slug ]) }}">{{ trans('index.trash') }}</a>
                        </li>
                        <li>
                            <a class="sub-item" href="{{ action('UsersController@updatesettings', ['id' => Auth::user()->username_slug ]) }}">{{ trans('index.settings') }}</a>
                        </li>
                        @if(Auth::user()->usertype=='Admin')
                        <li>
                            <a class="sub-item" href="/admin">{{ trans('index.adminp') }}</a>
                        </li>
                        @endif
                        <li>
                            <a class="sub-item" href="{{ action('Auth\AuthController@logout') }}">{{ trans('index.logout') }}</a>
                        </li>

                    </ul>
                </li>
            @else
                    @unless(Request::is('login') or Request::is('register'))
                <li class="pull-r">
                    <a class="signin_link" href="{{ action('Auth\AuthController@login') }}" rel="get:Loginform"><i class="fa fa-user" style="font-size:20px"></i></a>
                </li>
                    @endunless
            @endif

            </ul>
        </div>

        <div class="sections">
            <div class="scol1 col_sec">
                <div>
                    @if($DB_PLUGIN_NEWS == 'on')
                        <a class="biga firsg" data-type="news" href="{{ url('news') }}"> {{ trans('index.news') }}</a>
                        <div class="clear"></div>
                    @endif
                    @if($DB_PLUGIN_LISTS == 'on')
                        <a class="biga firsg" data-type="list" href="{{ url('lists') }}"> {{ trans('index.lists') }}</a>
                            <div class="clear"></div>
                        @endif
                    @if($DB_PLUGIN_QUIZS == 'on')
                        <a class="biga firsg" data-type="quiz" href="{{ url('quizzes') }}"> {{ trans('buzzyquiz.quizzes') }}</a>
                            <div class="clear"></div>
                    @endif
                    @if($DB_PLUGIN_POLLS == 'on')
                        <a class="biga firsg" data-type="poll" href="{{ url('polls') }}"> {{ trans('index.polls') }}</a>
                            <div class="clear"></div>
                    @endif
                    @if($DB_PLUGIN_VIDEOS == 'on')
                        <a class="biga firsg" data-type="video" href="{{ url('videos') }}"> {{ trans('index.videos') }}</a>
                    @endif
                </div>
            </div>
            <div class="scol2 col_sec">
                <div>
                    <ul id="cats_news" style="display: block">
                        @foreach(\App\Categories::where('type', 'news')->orderBy('name')->groupBy('name')->get() as $cat)
                            <li>
                                <a class="biga"  data-type="{{ $cat->name_slug }}" href="{{ url('/'.$cat->name_slug) }}"> {{ $cat->name }}</a>
                            </li>
                        @endforeach
                    </ul>    <ul id="cats_list">
                        @foreach(\App\Categories::where('type', 'list')->orderBy('name')->groupBy('name')->get() as $cat)
                            <li>
                                <a class="biga"  data-type="{{ $cat->name_slug }}" href="{{ url('/'.$cat->name_slug) }}">{{ $cat->name }}</a>
                            </li>
                        @endforeach
                    </ul>    <ul id="cats_quiz">
                        @foreach(\App\Categories::where('type', 'quiz')->orderBy('name')->groupBy('name')->get() as $cat)
                            <li>
                                <a class="biga"  data-type="{{ $cat->name_slug }}" href="{{ url('/'.$cat->name_slug) }}">{{ $cat->name }}</a>
                            </li>
                        @endforeach
                    </ul>    <ul id="cats_poll">
                        @foreach(\App\Categories::where('type', 'poll')->orderBy('name')->groupBy('name')->get() as $cat)
                            <li>
                                <a class="biga"  data-type="{{ $cat->name_slug }}" href="{{ url('/'.$cat->name_slug) }}">{{ $cat->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <ul id="cats_video">
                        @foreach(\App\Categories::where('type', 'video')->orderBy('name')->groupBy('name')->get() as $cat)
                            <li>
                                <a class="biga"  data-type="{{ $cat->name_slug }}" href="{{ url('/'.$cat->name_slug) }}">{{ $cat->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="scol3">
                <div id="catnews_last">

                </div>
                <div class="clear" style="padding:0"></div>
            </div>

        </div>
    </div>
</header>
{{--<div class="post-header">--}}
    {{--<p>Create Content People Love</p>--}}
{{--</div>--}}
{{--<div class="post-headers"></div>--}}