@extends("app")
@section('head_title',  getcong('sitename') .' | '.$post->title)
@section('head_description', $post->body)
@section('head_image', asset('/upload/media/posts/'.$post->thumb.'-b.jpg'))
@section('head_url', Request::url())

@section("content")

    <div class="content">

        <div class="container">
            <div class="mainside mainside-pro" style="margin:0px auto;float: none;">
                <div class="post-content" style="margin-top:7px; background: transparent" itemscope="" itemtype="http://schema.org/Article">

                    <div class="post">

                        <div class="post-head">
                            <a href="{{ url('profile/admin/options') }}" class="back-btn-pro"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                            @if($post->approve == 'draft')
                                <div class="label label-staff" >{{ trans('updates.thisdraftpost') }}</div>
                            @endif

                            <div class="drop-down"><i class="fa fa-angle-down"></i>
                                <form class="container_report" action="MAILTO:abuse@fortvision.com" method="post" enctype="text/plain">
                                    <input style="display: none" type="text" name="name" value="{{$post->title}}">
                                    <input class="report_post" type="submit" value="Report post">
                                </form>
                            </div>
                            <h1 itemprop="name" class="post-title">
                                {{ $post->title }}
                            </h1>
                                
                            @if (Auth::check())
                            @if ((Auth::user()->usertype == 'approve' && Auth::user()->id == $post->user_id) || (Auth::user()->usertype == 'NULL' && Auth::user()->id == $post->user_id))
                            <a href="{{ action('PostsController@CreateEdit', [$post->id]) }}" class="button button-green button-small" ><i class="fa fa-pencil-square iconp"></i> {{ trans('index.edit') }}</a>
                            @endif
                          @endif

                            <div class="create_fixed" style="margin-bottom: 10px;">

                                <a href="{{url('profile/admin/options')}}" >Create Your Own</a>

                            </div>

                            @can('update-post', $post)

                            @if(Auth::user()->usertype=='Admin')

                                <h5 class="pull-r" style="color:#aaa;line-height: 26px">{{ trans('index.admintools') }}</h5>

                                @if($post->approve == 'no')
                                    <a href="{{ action('Admin\PostsController@approvepost', $post->id) }}" class="button button-orange button-small"><i class="fa fa-check-square-o iconp"></i> {{ trans('index.approve') }}</a>
                                @endif
                            @else
                                @if((getcong('UserEditPosts')=='true' and getcong('UserDeletePosts')=='true'))
                                    <h5 class="pull-r" style="color:#aaa;line-height: 26px">{{ trans('index.ownertools') }}</h5>
                                @endif
                                @if($post->approve == 'no')
                                    <a href="#" class="button button-orange button-small" style="cursor: default"><i class="fa fa-circle-o-notch fa-spin iconp"></i> {{ trans('index.waitapprove') }}</a>
                                @endif
                            @endif

{{--                            @if($post->type !== 'poll')--}}
                                @if(/*getcong('UserEditPosts')=='true' or*/ Auth::user()->usertype=='Admin')
                                    <a href="{{ action('PostsController@CreateEdit', [$post->id]) }}" class="button button-green button-small" ><i class="fa fa-pencil-square iconp"></i> {{ trans('index.edit') }}</a>
                                  <a href="{{ action('PostsController@sendtrashpost', [$post->id]) }}" onclick="confim()" class="button button-red button-small " ><i class="fa fa-trash"></i></a>
                                @endif
                                @if(/*getcong('UserEditPosts')=='true' or*/ Auth::user()->usertype=='Staff' && Auth::user()->user_domain == $post->domain)
                                  <a href="{{ action('PostsController@CreateEdit', [$post->id]) }}" class="button button-green button-small" ><i class="fa fa-pencil-square iconp"></i> {{ trans('index.edit') }}</a>
                            @endif
                            {{--@endif--}}

                            @endcan

                            <p>
                                {!! nl2br($post->body) !!}
                            </p>

                            <div class="post-head__bar">
                                @if(isset($post->user->username_slug))
                                    <div class="user-info {{ $post->user->genre }} answerer">
                                        <div class="avatar left">
                                            <img src="{{ makepreview($post->user->icon , 's', 'members/avatar') }}" width="45" height="45" alt="{{ $post->user->username }}">
                                        </div>
                                        <div class="info">


                                            {!! trans('index.createdby', ['user' => '<a class="name" href="'.action('UsersController@index', [$post->user->username_slug ]) .'" target="_self">'.$post->user->username.'</a>' ]) !!}

                                            @if($post->user->usertype == 'Admin')
                                                <div class="label label-admin" style="margin-left:5px">{{ trans('updates.usertypeadmin') }}</div>
                                            @elseif($post->user->usertype == 'Staff')
                                                <div class="label label-staff" style="margin-left:5px">{{ trans('updates.usertypestaff') }}</div>
                                            @elseif($post->user->usertype == 'banned')
                                                <div class="label label-banned" style="margin-left:5px">{{ trans('updates.usertypebanned') }}</div>
                                            @endif

                                            <div class="detail">
                                                {!! trans('index.postedon', ['time' => '<time itemprop="datePublished">'.$post->published_at->diffForHumans() .'</time>' ]) !!}

                                                @unless($post->updated_at==$post->published_at)
                                                    , {!! trans('index.updatedon', ['time' => '<time itemprop="datePublished">'.$post->updated_at->diffForHumans() .'</time>' ]) !!}
                                                @endunless
                                            </div>

                                        </div>
                                    </div>
                                @endif

                                <div class="post-head__meta">
                                    <div class="posted-on">


                                    </div>

                                    <div class="topics-container clearfix">
                                        @if(isset($post->category->name_slug))
                                            <div class="item_category">
                                                <a href="{{ action('PagesController@showCategory', ['id' => $post->category->name_slug ]) }}">{{ $post->category->name }}</a>
                                            </div>
                                        @endif
                                        <div class="clear"></div>

                                    </div>

                                </div>

                            </div>
                            <div class="clear"></div>
                            <!-- @include("_particles.others.postsociallinks")-->
                            <div class="clear"></div>

                            {{--@foreach(\App\Widgets::where('type', 'PostShareBw')->where('display', 'on')->get() as $widget)--}}
                                {{--{!! $widget->text !!}--}}
                            {{--@endforeach--}}

                        </div>

                        <div class="clear"></div>
                        @if($post->type=='poll')
                            <img class="img-responsive" alt="{{ $post->title }}" src="{{ makepreview($post->thumb, 'b', 'posts') }}">
                        @endif
                        <article class="post-body" id="post-body" itemprop="text">

                            @include("_particles._lists.entryslists")

                        </article>
                        @if($post->type==3)
                            @include("_forms._pollform")
                        @endif

                        @if($post->type!="quiz")
                            <div class="addthis_sharing_toolbox"></div>
                            {{--                        @include("_particles.others.postsociallinks")--}}
                        @endif
                    </div>

                    @foreach(\App\Widgets::where('type', 'PostBelow')->where('display', 'on')->get() as $widget)
                        {!! $widget->text !!}
                    @endforeach


                </div>

                @include("_forms._reactionforms")

                @include("_forms._commentforms")

            </div>
            <!-- <div class="sidebar">

                @foreach(\App\Widgets::where('type', 'PostPageSidebar')->where('display', 'on')->get() as $widget)
            {!! $widget->text !!}
            @endforeach

                    <div class="colheader" style="border:0;text-transform: uppercase;">
                        <h1>{{ trans('index.today') }} {!! trans('index.top', ['type' => '<span style="color:#d92b2b">'.trans('index.posts').'</span>' ]) !!}</h1>
                </div>

                @include("_widgets.trendlist_sidebar")

            @include("_widgets.facebooklike")

                    </div>-->
            <div class="clear"></div>

            @if(isset($lastFeatures))
                @if(count($lastFeatures) >= 3)
                    <div class="colheader">
                        <h1>{{ trans('index.maylike') }}</h1>
                    </div>
                    @include("_widgets.post-between-comments")
                @endif
            @endif
        </div>

    </div>


@endsection
@section('footer')
    @if($post->type=="quiz")
        <script>
            BuzzyQuizzes = {
                'lang_1': '{{ trans('buzzyquiz.shareonface') }}',
                'lang_2': '{{ trans('buzzyquiz.shareontwitter') }}',
                'lang_3': '{{ trans('buzzyquiz.shareface') }}',
                'lang_4': '{{ trans('buzzyquiz.sharetweet') }}',
                'lang_5': '{{ trans('buzzyquiz.sharedone') }}',
                'lang_6': '{{ trans('buzzyquiz.sharedonedesc') }}'
            };


            $( document ).ready(function() {

                App.initQuizzesClicks();
            });
        </script>
    @endif
    @if($post->type=="poll")
        <script>
            $( document ).ready(function() {
                $('.poll_main_color').each(function(i){
                    $(this).css('width', $(this).attr('data-percent')+'%');
                });
            });
        </script>
    @endif
    <script async defer src="//platform.instagram.com/{{  getcong('sitelanguage') > "" ? getcong('sitelanguage') : 'en_US' }}/embeds.js"></script>
    <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>



    <style> .fb_dialog{z-index:999999999} </style>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/{{  getcong('sitelanguage') > "" ? getcong('sitelanguage') : 'en_US' }}/sdk.js#xfbml=1{!! getcong('facebookapp') > "" ? '&appId='.getcong('facebookapp') : '' !!}&version=v2.4";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-575a996f0d806356"></script>
@endsection