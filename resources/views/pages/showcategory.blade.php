@extends("app")
<?php $r=Request::segment(1) ?>

@section('head_title', $title .' | '.getcong('sitename') )
@section('head_description', $description )

@section("content")

@if(!empty($lastFeaturestop))
@if($r=='news' or $r=='lists' or $r=='quizzes' or $r=='polls' or $r=='videos')

    <div class="content shay">

        <div class="container shay">

            <div class="row homefeatures clearfix">
                <h1 style="margin-left: 5px;margin-bottom: 5px">{{ $title }}  <small style="color:#f1f1f1">|</small>

                        @foreach(\App\Categories::where('type', $typeo)->orderBy('name')->groupBy('name')->get() as $cat)

                                <a style="font-size:16px;margin-left:10px;color:#999;" data-type="{{ $cat->name_slug }}" href="/{{ $cat->name_slug }}"> {{ $cat->name }}</a>

                        @endforeach

                </h1>
                <div class="pull-l">
                    @foreach($lastFeaturestop->slice(0,1) as $item)
                        <div class="tile tile-4">
                            @include('._particles._lists.features_list', ['descof' => 'on','metaon' => 'on'])

                        </div>
                    @endforeach

                </div>
                <div class="pull-l">
                    @foreach($lastFeaturestop->slice(1,1) as $item)
                        <div class="tile tile-1">
                            @include('._particles._lists.features_list', ['descof' => 'on','metaon' => 'on'])

                        </div>
                    @endforeach

                </div>

                <div class="pull-l tway">
                    @foreach($lastFeaturestop->slice(2,2) as $item)
                        <div class="tile tile-3">
                            @include('._particles._lists.features_list', ['metaon' => 'on'])

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endif
@endif

    <div class="content">

        <div class="container">

            <div class="mainside">
                <div class="external-sign-in rss" style="margin:0;padding:0;width:auto;float:right">
                    <a class="Rss mini"  target=_blank style="width:24px;height:24px;margin:6px 0 0 0" href="{{$r}}.xml"></a></div>
                <style>.external-sign-in.rss a:after{ font-size:14px!important;  top: 5px!important;left:-7px}</style>
                <div class="colheader   none ">
                    @if(isset($search))
                            <h1>{{ $search }}</h1>
                    @elseif(isset($title))
                        @if($r=='news' or $r=='lists' or $r=='quizzes' or $r=='polls' or $r=='videos')
                            <h1>{{ trans('index.latest', ['type' => $title ]) }}</h1>
                        @else
                            <h1>{{ $title }}</h1>
                        @endif
                    @endif

                </div>


                @if($lastItems->total() > 0)
                    <div class="jscroll" data-auto="{!!  getcong('AutoLoadLists') ?: 'false' !!}">
                    @include('pages.catpostloadpage')
                    </div>
                    @else
                    @include('errors.emptycontent')

                @endif

            </div>
            <div class="sidebar">

                @foreach(\App\Widgets::where('type', 'CatSide')->where('display', 'on')->get() as $widget)
                    {!! $widget->text !!}
                @endforeach
                    @if($lastNews)

                    <div class="colheader" style="border:0;text-transform: uppercase">
                        <h1>{{ trans('index.weekly') }} {!! trans('index.top', ['type' => '<span style="color:#d92b2b">'.$title.'</span>' ]) !!}</h1>
                    </div>
                @include("_widgets.trendlist_sidebar")
                    @endif
                @include("_widgets/facebooklike")

            </div>
        </div>

    </div>


@endsection