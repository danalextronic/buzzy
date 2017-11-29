@extends("app")
@section("content")
@unless(count($lastFeaturestop)==0)
<div class="content shay">
    <div class="container shay">
        <div class="row homefeatures clearfix">
            <div class="pull-l">
                @foreach($lastFeaturestop->slice(0,1) as $item)
                    <div class="tile tile-2">
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
@endunless
@section('content')
    <div class="content" >
        <div class="container" style="padding:100px 0 0 0;text-align: center">
		 <!-- options buttons start here -->
          <?php
          if (!empty($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) == false) {
            session_start();
            $_SESSION['URL_FROM'] = $_SERVER['HTTP_REFERER'];
            $_SESSION['POST_DOMAIN'] = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
          }
          ?>
<div class="icons_area">
    	<ul class="box-flex-items">
        	<li class="four_part poll"><a href="/create?new=poll">

            	<img src="/images/poll.png" />
                    <p>{{ trans('index.poll') }}</p>
            </a></li>
            
            <li class="four_part quiz"><a href="/create?new=quiz">

            	<img src="/images/quiz.png" />
                    <p>{{ trans('index.quiz') }}</p>
            </a></li>
            
            <li class="four_part post"><a href="/create?new=post">
            	<img src="/images/Post.png" />
                    <p>{{ trans('index.post') }}</p>

                </a></li>
            
        </ul>
    </div>
            @if($editor_pick->count() != 0)
            <div class="slider-container">
                <h4 class="title-slider">{{trans('index.editors_picks') }}</h4>
                <div class="slider1">

                    @foreach($editor_pick as $pick)
                        <div class="slide">
                            <a href="{{ makeposturl($pick) }}">
                                <div><img src="/upload/media/posts/{{ $pick->thumb }}-s.jpg"></div>
                                <p>
                                    {{$pick->title}}
                                </p>

                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
		 
		 
		 
		 
			 <!--div style="border:0px solid #ff0000; position:relative;">
			  <div style="width:70%; height:50px; margin:0 auto;">Create a new</div>
			  <div style="width:70%; height:50px; margin:0 auto; border:0px solid #ff0000; background:#fff;">
			   <table style="margin:0 auto;" cellspacing="2" cellpadding="2">
				<tr>
				 <td style="text-align:center;">
				  <a href="/create?new=poll">Poll</a>
				 </td>
				 <td style="text-align:center;">
				  <a href="/create?new=quiz">Quiz/Trivia</a>
				 </td>	
				 <td style="text-align:center;">
				  Video
				 </td>	
				 <td style="text-align:center;">
				  Post
				 </td>			 
				</tr>
				<tr>
				 <td style="text-align:center;">
				  <a href="/create?new=poll"><img src="http://dev.codecan.com/images/poll.png" width="100px;"></a>
				 </td>
				 <td style="text-align:center;">
				  <a href="/create?new=quiz"><img src="http://dev.codecan.com/images/quiz.png" width="100px;"></a>
				 </td>
				 <td style="text-align:center;">
				  <img src="http://dev.codecan.com/images/feed.png" width="100px;">
				 </td>
				 <td style="text-align:center;">
				  <img src="http://dev.codecan.com/images/Post.png" width="100px;">
				 </td>			 
				</tr>
			   </table>
			  </div>
			 </div-->
			 <!-- options buttons end here -->
        </div>
    </div>
@endsection

@section('footer')
  <script>
    $(document).ready(function(){
      $('.slider1').bxSlider({
        slideWidth: 220,
        minSlides: 2,
        maxSlides:4,
//        infiniteLoop: false
      });
    });
  </script>
    @if(!Auth::check())
        <script>
            $(function ($) {
                $('.icons_area li').on('click', function() {
                    $.cookie('url-to', $(this).find('a').attr('href'));
                    return true;
                });
            });
        </script>
    @endif
    <script>
        $(function ($) {
            if($.cookie('url-to')) {
                var href = $.cookie('url-to');
                $.removeCookie('url-to');
                window.location = href;
            }
        });
    </script>
@stop
