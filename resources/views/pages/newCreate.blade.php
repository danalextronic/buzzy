@extends("app")
@section('head_title', trans('addpost.create', ['type' => $typenetitle ]).' | '.getcong('sitename'))
@section("header")
    <link rel="stylesheet" href="/assets/plugins/editor/simditor.css">
@endsection
@section("content")

    <div class="content add-form">
        {!!   Form::open(array('action' => 'PostsController@CreateNewPost', 'method' => 'POST', 'onsubmit' => 'return false', 'enctype' => 'multipart/form-data')) !!}
        <div class="container" style="background-color: #f9f9f9">
            <div class="mainside">

                <div class="question-post-form" data-type="{{ $typene }}">
                    <h1 class="createtitle">
                        {{ trans('addpost.create', ['type' => $typenetitle ]) }}
                    </h1>
                    <fieldset>
                        <div class="clear"></div>

                        <section class="form">

                            <legend>{{ trans('addpost.title') }}</legend>
                            <div class="cd-form">
                                {!! Form::text('headline', null , ['class' => 'cd-input ', 'placeholder' => trans('addpost.titleplace')]) !!}
                            </div>
                             {{--<legend>{{ trans('addpost.desc') }}</legend>
                            <div class="cd-form">
                                {!! Form::textarea('description', null , ['class' => 'cd-input ','style' => 'height:80px', 'placeholder' => trans('addpost.descplace')]) !!}
                            </div>--}}


                            {{--<legend>{{ trans('addpost.image_tags') }}</legend>--}}
                            {{--<div class="cd-form">--}}
                                {{--{!! Form::text('tag_title', null , ['class' => 'cd-input ', 'placeholder' => trans('addpost.image_tagsplace')]) !!}--}}
                            {{--</div>--}}


                        </section>

						@if($typene=='poll')
                        <section class="form">





							<!--div @if(isset($entry->image)) style="display: none;" @endif>
							 <div style="display:inline;">

							 <div style="float:left; background: url(/images/Upload.png) no-repeat; width:100px; height:100px; background-size:100%; cursor:pointer;">
							  <form action="">
							  <input type="file" accept="image/*" class="uploadaimage" data-target="entry" style="filter: alpha(opacity=0); opacity: 0;">
							  </form>
							  </div>
							 </div>



							<div class="image-upload-actions" style="display:inline; cursor:pointer;">
								<a class="getimageurl" data-action="add" data-target="preview"> <img src="/images/URL.png" width="100px;" /></a>
							</div>


							 <div style="display:inline; cursor:pointer;"><a href="/postimages/" rel="modal:open"><img src="/images/Library.png" width="100px;" /></a></div>

							 </div-->

								<!--div class="inpunting mediaupload" @if(isset($entry->image)) style="display: none;" @endif>
									<div class="item-media-placeholder" style="padding-top: 70px;padding-bottom: 70px">
										<i class="fa fa-picture-o  fa-2x"></i><br>
										<small class="text-muted">{{ trans('addpost.entry_addimage') }}</small>
										<form action="">
										<input type="file" accept="image/*" class="uploadaimage" data-target="entry">
										</form>
										<div style="font-size:12px;color:#ccc"> {{ trans('updates.or') }} </div>
										<div class="image-upload-actions">
											<a class="button button-white getimageurl" data-action="add" data-target="entry">{{ trans('updates.getfromurl') }} <i class="fa fa-download"></i></a>
										</div>
									</div>
								</div-->
                        </section>
						@endif

                        @if($typene=='list')
                        <section class="form">
                            <legend>{{ trans('addpost.listtype') }}</legend>
                            <div class="lists-types">
                                <a class="button button-gray selected" data-order="asc">
                                    <i class="fa fa-sort-numeric-asc"></i>
                                    <strong>{{ trans('addpost.listasc') }}</strong>
                                </a>
                                <a class=" button button-white" data-order="desc">
                                    <i class="fa fa-sort-numeric-desc"></i>
                                    <strong>{{ trans('addpost.listdesc') }}</strong>
                                </a>
                                <a class=" button button-white last" data-order="none">
                                    <i class="fa fa-list-ul"></i>
                                    <strong>{{ trans('addpost.normallist') }}</strong>
                                </a>

                            </div>
                        </section>
                        @endif


                        @if($typene=='quiz')
                            <!--section class="form last" id="addnew"  style="border-bottom: 1px solid #e3e3e3;">


                                <legend>{{ trans('buzzyquiz.quizresults') }}</legend><br>

                                <div id="results">

                                    @include('_forms._buzzyquiz.__addresultform')

                                </div>


                                <a class="submit-button button button-rosy button-big button-full postable" style="width:100%;float:none;padding-left:0;padding-right:0;" data-method="Get" data-target="results" data-puttype="append" data-type="resultform" href="{{ action('FormController@addnewform') }}?addnew=result" ><i class="fa fa-check-circle-o"></i>{{ trans('addpost.add', ['type' => trans('buzzyquiz.result')]) }}</a>
                                <br><br><br><br>
                            </section-->
                        @endif

                        <section class="form this-pro" >
                            <legend>{{ trans('addpost.entries', ['type' => $typenetitle ]) }}</legend><br>
                            <div id="entries">
                                @if($typene=='poll')
                                <div class="poll-pro">
                                @endif
                                @if($typene=='video')

                                    @include('_forms.__addvideoform')

                                    @elseif($typene=='list')

                                    @include('_forms.__addimageform')

                                    @elseif($typene=='quiz')

                                    @include('_forms._buzzyquiz.__addquestionform')

                                    @elseif($typene=='poll')

                                    @include('_forms.__addpollform')
                                    @include('_forms.__addpollform')

                                    @else

                                    @include('_forms.__addtextform')

                                @endif
                                    @if($typene=='poll')
                                    </div>
                                @endif
                            </div>

                            @if($typene=='quiz')
                                <!--a class="submit-button button button-blue button-full postable"  style="width:100%;float:none;padding-left:0;padding-right:0;" data-method="Get" data-target="entries" data-puttype="append" data-type="questionform" href="{{ action('FormController@addnewform') }}?addnew=question"><i class="fa fa-question-circle"></i>{{ trans('addpost.add', ['type' => trans('buzzyquiz.question')]) }}</a>


                                <div class="clear"></div>
                                <br><br><br-->
                            @endif

                        </section>

                        @unless($typene=='quiz')
                        <section class="form last" id="addnew">
                            @include('posts.add-entry')
                        </section>
                        @endunless
                        <div class="clear"></div>
                    </fieldset>

                </div>

            </div>

            @include('posts.create-sidebar')


        </div>
        {!! Form::close() !!}
    </div>

@endsection
@section("footer")
    @include('posts.create-footerjs')
    <script>
        $(function ($) {
            if ($('input#URL_FROM').val().length > 0) {
                $('#text_lp1').val($('input#URL_FROM').val());
            }
        });
    </script>
@endsection