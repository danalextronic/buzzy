<div class="box box-widget widget-user" style="margin-bottom: 30px">
    <div class="overlay hide">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header  bg-default" style=" height: 140px;background: #FBFBFB;padding: 20px 120px 20px 20px;">
        <h3 class="widget-user-username" style="font-weight: 500;text-shadow: none">{{ $p_name }}</h3>
        <h5 class="widget-user-desc" style="line-height:16px;font-weight: 500;color:#777">{!! $p_desc  !!} </h5>
        <div class="info">
            {!!  $p_weblink == null ? '' : '<a href="'.$p_weblink.'" target="_blank" style="margin-right:10px"><i class="fa fa-globe" style="margin-right:3px"></i> Web site</a>'  !!}
            {!!  $p_docslink == null ? '' : '<a href="'.$p_docslink.'" target="_blank"><i class="fa fa-book" style="margin-right:3px"></i> Docs</a>'  !!}
        </div>
    </div>
    <div class="widget-user-image" style=" top: 15px;left:auto;right: 15px; margin-left:0;">
        <img class="img-circle" src="{{ $p_icon }}" alt="{{ $p_name }}">
    </div>
    <?php
    $p_activetihs=false;
    if (file_exists(base_path('storage/.'.$p_code))) {
        $p_activetihs=true;
    }
    $p_actfilescont=false;
    if (!empty(trans('p-'.$p_code.'.p_version'))) {
        $p_actfilescont=true;
    }
        if($p_code=='easycomment'){
            $p_actfilescont=true;
        }
    ?>
    <div class="box-footer" style="height: 60px;max-height: 60px; padding: 15px 10px 10px 15px;">
        <div class="row">
            <div class="col-sm-4 border-right">
             @unless($p_price=='soon')
                @if($p_price!='FREE' and $p_status!='actived')
                    @if($p_activetihs==false)
                        <button type="button" data-item="{{ $p_code }}"  data-img="{{ $p_icon }}" data-verify="{{ $p_price!='FREE' ? 'on' : 'off' }}" class="btn btn-block btn-warning btn-sm checkcodeforplugin" style="text-align: left;width:auto"><i class="fa fa-unlock" style="margin-right:10px"></i> Activate Code</button>
                    @elseif($p_actfilescont==false)
                            <span class="badge bg-white">Activated! But detected some missing files for this plugin.<br> Please upload plugin files you download from CodeCanyon.</span>
                    @else
                        <button type="button" data-item="{{ $p_code }}" data-verify="{{ $p_price!='FREE' ? 'on' : 'off' }}" class="btn btn-block btn-success btn-sm activebut" style="text-align: left"><i class="fa fa-download" style="margin-right:10px"></i> Install</button>
                    @endif

                    @else
                        @if($p_status=='actived')
                            <button type="button" data-item="{{ $p_code }}" data-verify="{{ $p_price!='FREE' ? 'on' : 'off' }}" class="btn btn-block btn-default btn-sm activebut acthover" style="text-align: left"><span class="current show"><i class="fa fa-check" style="margin-right:10px"></i> Activated</span><span class="hover hide"><i class="fa fa-remove" style="margin-right:10px"></i> Deactivate</span></button>

                        @elseif($p_status=='notactived')
                            <button type="button" data-item="{{ $p_code }}" data-verify="{{ $p_price!='FREE' ? 'on' : 'off' }}" class="btn btn-block btn-info btn-sm activebut" style="text-align: left"><i class="fa fa-download" style="margin-right:10px"></i> Install</button>
                        @else


                         @endif
                    @endif
             @endunless

                               <!-- /.description-block -->
            </div>
            <!-- /.col -->
            @unless($p_actfilescont==false)
            <div class="col-sm-4 border-right">
                @if($p_price!='FREE' and $p_status!='actived' and $p_activetihs==false)
                    {!!  $p_buylink == null ? '' : '<a href="'.$p_buylink.'" class="btn btn-block btn-success btn-sm"  target="_blank"><i class="fa fa-cart-plus" style="margin-right:10px"></i> Buy Now</a>'  !!}
                 @else
                    @if($p_settingon)
                        <button type="button" data-item="{{ $p_code }}" class="btn btn-block btn-warning  btn-sm " data-toggle="modal" data-target="#modal{{$p_code}}" style="float:left;width:auto;text-align: left"><i class="fa fa-cog" style="margin-right:0"></i> </button>

                    @endif
                @endif

            </div>
            <!-- /.col -->
            <div class="col-sm-4" style="text-align: center">
                @if($p_price=='soon')
                    <span class="badge bg-white">Not availabe yet</span>
                @elseif($p_price=='FREE')
                    <span class="badge bg-white" style="font-weight:400;color: #969696;background-color: #F0F0F0;">{{ $p_price }}</span>
                @else
                    <span class="badge bg-green">{{ $p_price }}</span>
                @endif
                <!-- /.description-block -->
            </div>
            @endunless
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <style> .acthover:hover .current{display:none!important} .acthover:hover .hover{display:block!important}</style>
   @if($p_settingon)

        <div class="modal modal-info" id="modal{{$p_code}}">
            <div class="modal-dialog" @if($p_code == "homepagebuilder")style="width:80%" @endif>
                <div class="modal-content">
                    {!!   Form::open(array('action' => 'Admin\ConfigController@setconfig', 'method' => 'POST', 'enctype' => 'multipart/form-data')) !!}
                    @if($p_code == "easycomment")
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-remove"></i></button>
                        <h4 class="modal-title">easyComment Plugin Settings</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label">easyComment Theme</label>
                            {!! Form::select('easyCommentTheme', ['Default' => 'Default','Dark' => 'Dark','Boxed' => 'Boxed','Envato' => 'Envato', 'Blog' => 'Blog'], getcong('easyCommentTheme'), ['class' => 'form-control'])  !!}
                            <p >You can change theme of comment area. <a target="_blank" href="http://easycomment.akbilisim.com/example.html">See Theme Demos Here.</a></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">easyComment Title</label>
                            <input type="text" class="form-control input-lg" name="easyCommentTitle" value="{{  getcong('easyCommentTitle') }}">
                            <p >You may want to change Title of comments. Default: Comments</p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">easyComment Initiation Url</label>
                            <input type="text" class="form-control input-lg" name="easyCommentcode" value="{{  getcong('easyCommentcode') }}">
                        </div>
                    </div>
            @elseif($p_code == "disquscomments")

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-remove"></i></button>
                            <h4 class="modal-title">Disqus Plugin Settings</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label">Disqus Code</label>
                                <textarea name="DisqussCommentcode" style="height:120px" class="form-control">{{  getcong('DisqussCommentcode') }}</textarea>
                            </div>
                        </div>
                    @elseif($p_code == "buzzyquizzes")

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-remove"></i></button>
                            <h4 class="modal-title">Buzzy Quizzes Plugin Settings</h4>
                        </div>

                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label">Quizzes Plugin Result Type</label>
                                {!! Form::select('BuzzyQuizzesPopup', ['on' => 'Buzzy Quizzes Special Result Popup', 'off' => 'Only BuzzFeed Style Result'], getcong('BuzzyQuizzesPopup'), ['class' => 'form-control'])  !!}
                                <p>You can change result area of Quizzes.</p>
                            </div>

                        </div>
                    @elseif($p_code == "buzzycontact")
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-remove"></i></button>
                            <h4 class="modal-title">Buzzy Contact Plugin Settings</h4>
                        </div>


                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label">Buzzy Contact Name</label>
                                <input type="text" class="form-control input-lg" name="BuzzyContactName" value="{{  getcong('BuzzyContactName') }}">
                                <p>This name will appear on mail</p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Buzzy Contact Email</label>
                                <input type="text" class="form-control input-lg" name="BuzzyContactEmail" value="{{  getcong('BuzzyContactEmail') }}">
                                <p>This email will appear on mail</p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email Signature</label>
                                <textarea  class="form-control input-lg" name="BuzzyContactSignature">{{  getcong('BuzzyContactSignature') }}</textarea>
                                <p>You can type a signature for mail sending</p>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class="control-label">Send a copy to my email</label>
                                <input type="text" class="form-control input-lg" name="BuzzyContactCopyEmail" value="{{  getcong('BuzzyContactCopyEmail') }}">
                                <p>Please type an email if you want to get email alert for contact request. System will sent you a copy. Please leave empty if you dont want to</p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Use captcha on contact form</label>
                                {!! Form::select('BuzzyContactCaptcha', ['on' => 'Yes use', 'off' => 'No need'], getcong('BuzzyContactCaptcha'), ['class' => 'form-control'])  !!}
                            </div>
                            <div class="form-group">
                                <label class="control-label">Google reCaptcha Api Key</label>
                                <input type="text" class="form-control input-lg" name="reCaptchaKey" value="{{  getcong('reCaptchaKey') }}">
                                <p>Get your Google reCaptcha Api Key and Secret http://www.google.com/recaptcha/intro/index.html</p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Google reCaptcha Api Secret</label>
                                <input type="text" class="form-control input-lg" name="reCaptchaSecret" value="{{  \Auth::user()->email == 'demo@admin.com' ?  "-YOU DO'NT HAVE PERMISSION TO SEE THAT-" : getcong('reCaptchaSecret')  }}">
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    @elseif($p_code == "homepagebuilder")

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-remove"></i></button>
                            <h4 class="modal-title">Buzzy Homepage Builder</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-6 col-xs-3">
                                <h2 class="control-label">Column 1</h2>
                                <div class="form-group">
                                    <label class="control-label">Section 1 Title</label>
                                    <input type="text" class="form-control input-lg" name="HomeColSec1Tit1" value="{{ getcong('HomeColSec1Tit1') }}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Selected Types or Categories</label>
                                    {!! Form::select('HomeColSec1Type1[]', $typeos, getcong('HomeColSec1Type1'), ['class' => 'form-control','style' => 'height:220px','multiple' => 'multiple'])  !!}
                                </div>

                            </div>
                            <div class="col-lg-4 col-xs-3">
                                <h2 class="control-label">Column 2</h2>
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control input-lg" name="HomeColSec2Tit1" value="{{ getcong('HomeColSec2Tit1') }}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Selected Types or Categories</label>
                                    {!! Form::select('HomeColSec2Type1[]', $typeos, getcong('HomeColSec2Type1'), ['class' => 'form-control','style' => 'height:220px','multiple' => 'multiple'])  !!}
                                </div>
                            </div>
                            <div class="col-lg-2 col-xs-3">
                                <h2 class="control-label">Column 3</h2>
                                <div class="form-group">
                                    <label class="control-label">Trendings On/Off?</label>
                                    {!! Form::select('HomeCol3Trends', ['true' => 'Enabled', 'false' => 'Disabled'], getcong('HomeCol3Trends'), ['class' => 'form-control'])  !!}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control input-lg" name="HomeColSec3Tit1" value="{{ getcong('HomeColSec3Tit1') }}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Selected Types or Categories</label>

                                    {!! Form::select('HomeColSec3Type1[]', $typeos, getcong('HomeColSec3Type1'), ['class' => 'form-control','style' => 'height:150px','multiple' => 'multiple'])  !!}
                                </div>

                            </div>
<div class="clearfix"></div>
                        </div>
                    @endif<div class="clearfix"></div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <input type="submit" value="Save Settings" class="btn btn-info btn-outline">

                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

   @endif
</div>
