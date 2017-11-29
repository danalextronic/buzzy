<legend>{{ trans('addpost.addnew') }}</legend>
@if($typene=='poll')
    <legend>{{ trans('addpost.images') }}</legend>

    <div class="icons_area" @if(isset($entry->image)) style="display: none;" @endif>
        <ul class="box-flex-items">
            <li class="three_part library"><a href="/postimages/" rel="modal:open">
                    <img src="images/Library.png" />
                    <p>{{ trans('addpost.explorelibrary') }}</p>
                </a></li>

            <li class="image-upload-actions three_part url"><a href="#s" class="getimageurl" data-action="add" data-target="preview">
                    <img src="images/URL.png" />
                    <p>{{ trans('addpost.formurl') }}</p>
                </a></li>

            <li class="three_part upload">
                <label for="file-5"><div style="width:100%;"><img src="images/Upload.png" /></div>
                    <p style="margin-top:20px;">{{ trans('addpost.filechoose') }}</p></label>
                <div>
                    <form action="">
                        <input type="file" accept="image/*" data-target="entry" style="filter: alpha(opacity=0); opacity: 0;" name="file-5[]" id="file-5" class="uploadaimage inputfile inputfile-4" data-multiple-caption="{count} files selected" multiple />
                    </form>

                </div>

            </li>

        </ul>
    </div>
@endif
@unless($typene=='poll')
    @if($typene!='news')
    <a class="button button-blue button-big submit-button postable " data-method="Get" data-target="entries" data-puttype="append" data-type="textform" href="{{ action('FormController@addnewform') }}?addnew=text" ><i class="fa fa-file-text"></i>{{ trans('addpost.add', ['type' => trans('addpost.text')]) }}</a>
    @endif
    @unless($typene=='video')
        <a class="button button-blue button-big submit-button postable " data-method="Get" data-target="entries" data-puttype="append" data-type="imageform" href="{{ action('FormController@addnewform') }}?addnew=image" ><i class="fa fa-picture-o"></i>{{ trans('addpost.add', ['type' => trans('addpost.image')]) }}</a>
    @endunless
    <a class="button button-red button-big submit-button postable" data-method="Get" data-target="entries" data-puttype="append" data-type="videoform" href="{{ action('FormController@addnewform') }}?addnew=video"><i class="fa fa-youtube-play"></i>{{ trans('addpost.add', ['type' => trans('addpost.video')]) }}</a>

    {{--<form class="form-horizontal" role="form" method="POST" action="{{'PostsController@postCreate'}}" enctype="multipart/form-data">--}}
        {{--{{ csrf_field() }}--}}
        {{--<div class="form-group">--}}
            {{--<label for="video_file" class="col-sm-3 control-label"><i class="fa fa-youtube-play" aria-hidden="true"></i> Add Video</label>--}}
            {{--<div class="col-sm-6">--}}
                {{--<input type="file" id="video_file" name="video_file">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<div class="col-sm-offset-3 col-sm-3">--}}
                {{--<button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-cloud-upload"></i>Create Form</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</form>--}}


    <a class="button button-blue button-pros button-big submit-button moreentry" href="javascript:;" >{{ trans('updates.more') }} <i class="fa fa-caret-down" style="margin:0 0 0 10px"></i></a>

    <div class="moreentrywidget" style="display: none">
    <a class="button button-blue button-big submit-button postable" data-method="Get" data-target="entries" data-puttype="append" data-type="tweetform" href="{{ action('FormController@addnewform') }}?addnew=tweet"><i class="fa fa-twitter"></i>{{ trans('addpost.add', ['type' => trans('updates.tweet')]) }}</a>

    <a class="button button-blue button-big submit-button postable" data-method="Get" data-target="entries" data-puttype="append" data-type="facebookpostform" href="{{ action('FormController@addnewform') }}?addnew=facebookpost"><i class="fa fa-facebook"></i>{{ trans('addpost.add', ['type' => trans('updates.facebookpost')]) }}</a>

    <a class="button button-instagram button-big submit-button postable" data-method="Get" data-target="entries" data-puttype="append" data-type="instagramform" href="{{ action('FormController@addnewform') }}?addnew=instagram"><i class="fa fa-instagram"></i>{{ trans('addpost.add', ['type' => trans('updates.instagram')]) }}</a>

    <a class="button button-soundcloud button-big  submit-button postable" data-method="Get" data-target="entries" data-puttype="append" data-type="soundcloudform" href="{{ action('FormController@addnewform') }}?addnew=soundcloud"><i class="fa fa-soundcloud"></i>{{ trans('addpost.add', ['type' => trans('updates.soundcloud')]) }}</a>

    <a class="button button-blue button-big submit-button postable" data-method="Get" data-target="entries" data-puttype="append" data-type="embedform" href="{{ action('FormController@addnewform') }}?addnew=embed" ><i class="fa fa-code"></i>{{ trans('addpost.add', ['type' => trans('addpost.embed')]) }}</a>
    </div>
@endunless