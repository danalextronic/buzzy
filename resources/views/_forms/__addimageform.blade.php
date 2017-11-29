<div class="entry" data-type="image" @if(isset($entry->id)) data-entry-id="{{ $entry->id }}" @endif>
    @include('_forms.__entryactions')
    <h3><i class="fa fa-picture-o"></i> {{ trans('addpost.image') }}</h3>
    <div class="inpunting ordering ">
         <button class="order-number button button-gray">1</button>
        {!! Form::text(null, isset($entry->title) ? $entry->title : null ?: null, ['data-type' => 'title', 'class' => 'cd-input ', 'placeholder' => trans('addpost.entry_titleop')]) !!}
    </div>
    <div class="inpunting mediaupload" @if(isset($entry->image)) style="display: none;" @endif>
        <div class="item-media-placeholder">
            <ul class="box-flex-items  video-items">
                <li class="three_part library"><a href="/postimages/" rel="modal:open">
                        <img src="/images/Library.png" />
                        <p>Explore Library</p>
                    </a></li>

                <li class="image-upload-actions three_part url"><a class="getimageurl" data-action="add" data-target="entry">
                        <img src="/images/URL.png" />
                        <p>Form Url</p>
                    </a></li>

                <li class="three_part upload">
                    <div class="upload-container">
                        <form action="">
                            <input type="file" accept="image/*" data-target="entry" style="filter: alpha(opacity=0); opacity: 0;" class="uploadaimage inputfile inputfile-4"  />
                        </form>
                        <div style="width:100%;"><img src="/images/Upload.png" /></div> <p >Choose a file&hellip;</p>
                    </div>
                </li>
            </ul>


        </div>
    </div>
    {!! Form::hidden(null, isset($entry->image) ? makepreview($entry->image, null, 'entries') : null, ['data-type' => 'image', 'class' => 'cd-input-image ']) !!}
    <div class="inpunting imagearea @if(empty($entry->image)) hide @endif">
        <div class="imagearea_img">
        @if(isset($entry->image)) <img src="{{ makepreview($entry->image, null, 'entries') }}"> @endif
        </div>
        <div class="thumbactions">
            <a class="button button-red deleteimage" data-action="remove" data-target="image"><i class="fa fa-trash"></i></a>  <a class="button button-white makepreview"><i class="fa fa-image"></i>&nbsp;{{ trans('addpost.makepreview') ?: 'Make preview image' }}</a>
        </div>
    </div>
    <div class="moredetail text">

        <div class="detailhide" style="display:none">
                <div class="inpunting">
                    {!! Form::text(null, isset($entry->source) ? $entry->source : null, ['data-type' => 'source', 'class' => 'cd-input ', 'placeholder' => trans('addpost.entry_source')]) !!}
                </div>
               <div class="inpunting">
               {!! Form::textarea(null, isset($entry->body) ? $entry->body : null, ['data-type' => 'body', 'class' => 'message','id' => 'edit', 'placeholder' => trans('addpost.entry_body')]) !!}
                </div>
        </div>
        <a href="javascript:;" class="trigger"><span class="down">{{ trans('addpost.mored') }} <i class="fa fa-angle-down"></i></span><span class="up">{{ trans('addpost.lessd') }}  <i class="fa fa-angle-up"></i></span></a>
    </div>

</div>
