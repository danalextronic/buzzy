<div class="answer" data-type="answer" @if(isset($entry->id)) data-entry-id="{{ $entry->id }}" @endif>
<div  class="answer-wrapper">
    <div class="entryactions">
        <button class="button button-white get-button delete-entry" data-block="answer"><i class="fa fa-remove"></i></button>
    </div>
    <span class="drag-handle"> <i class="fa fa-arrows fa-2x"></i></span>
    <div class="inpunting mediaupload" @if(isset($entry->image)) style="display: none;" @endif>
        <div class="item-media-placeholder list-item">
            {{--<i class="fa fa-plus fa-2x"></i><br>--}}
            {{--<form action="">--}}
            {{--<input type="file" accept="image/*" class="uploadaimage" data-target="answer">--}}
            {{--</form>--}}
            {{--<div class="upload-or-url"> {{ trans('updates.or') }} </div>--}}
            <ul class="box-flex-items">
                <li class="three_part library"><a href="/postimages/" rel="modal:open">
                        <img src="/images/Library.png" />
                        <p>{{ trans('addpost.explorelibrary') }}</p>
                    </a></li>

                <li class="image-upload-actions three_part url"><a class="getimageurl" data-action="add" data-target="answer">
                        <img src="/images/URL.png" />
                        <p>{{ trans('addpost.formurl') }}</p>
                    </a></li>

                <li class="three_part upload">
                    <div class="upload-container">
                        <form action="">
                            <input type="file" accept="image/*" data-target="answer" style="filter: alpha(opacity=0); opacity: 0;" class="uploadaimage inputfile inputfile-4"  />
                        </form>
                        <div style="width:100%;"><img src="/images/Upload.png" /></div> <p >{{ trans('addpost.filechoose') }}</p>
                    </div>

                </li>

            </ul>
        </div>
    </div>
    {!! Form::hidden(null, isset($entry->image) ? makepreview($entry->image, null, 'answers') : null, ['data-type' => 'image', 'class' => 'cd-input-image ']) !!}
    <div class="inpunting imagearea @if(empty($entry->image)) hide @endif">
        <div class="imagearea_img">
        @if(isset($entry->image)) <img src="{{ makepreview($entry->image, null, 'answers') }}"> @endif
        </div>
        <div class="thumbactions">
            <a class="button button-red deleteimage" data-action="remove" data-target="answer"><i class="fa fa-trash"></i></a>
        </div>
    </div>

    <div class="inpunting " style=" padding:0">
        {!! Form::textarea(null, isset($entry->title) ? $entry->title : null ?: null, ['data-type' => 'title', 'class' => 'cd-input answerinput', 'placeholder' => trans('buzzyquiz.entry_answertitle')]) !!}
    </div>
    <div class="inpunting " style="background:#ccc; padding:0">
        <?php $idoa=time(); ?>
        {{-- {!! Form::select(null, ['' => trans('buzzyquiz.assign')] , null, [ 'class' => 'getassignres', 'data-identy' => $idoa, 'data-acst' =>  isset($entry->video) ? (int)$entry->video : null, 'data-type' => 'assign' ]) !!} --}}
		<?php
		 if(isset($entry->is_correct) && $entry->is_correct == 1){
		  $chk = 'checked';
		 } else {
		  $chk = '';
		 }
		?>
		<input type="checkbox" data-type="is_correct" <?php echo $chk; ?> > {{ trans('addpost.iscorrect') }}
    </div>
</div>
</div>
