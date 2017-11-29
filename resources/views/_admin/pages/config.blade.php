@extends("_admin.adminapp")
        @section('header')
             <link rel="stylesheet" href="/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.css">
        @endsection
@section("content")
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Settings
        <small>Site Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Settings</li>
    </ol>
</section>

<section class="content">
    {!!   Form::open(array('action' => 'Admin\ConfigController@setconfig', 'method' => 'POST', 'enctype' => 'multipart/form-data')) !!}
@if(Request::query('q') == 'others')

        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Optional Configurations</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>
                               Site Posts Url Type?
                            </label>
                            {!! Form::select('siteposturl', [
                            '1' => 'yoursite.com/{type}/{slug} (Default)',
                            '2' => 'yoursite.com/{type}/{id}',
                            '3' => 'yoursite.com/{username}/{slug}',
                            '4' => 'yoursite.com/{username}/{id}'
                             ], getcong('siteposturl'), ['class' => 'form-control'])  !!}

                        </div>
                        <span class="help-block">You can change your post pages url here.</span>

                        <hr>
                        <div class="form-group">
                                <label class="control-label">Auto-listed on Homepage</label>
                                {!! Form::select('AutoInHomepage', ['true' => 'On - Show all approved posts','false' => 'Disable - Only show up picked ones'], getcong('AutoInHomepage'), ['class' => 'form-control'])  !!}

                            <span class="help-block">If this option is enabled, all new posts show up in homepage. If disabled admins must select posts for homepage</span>
                        </div>
                        <hr>
                        <div class="form-group">
                                <label class="control-label">Auto Approve Posts</label>
                                {!! Form::select('AutoApprove', ['true' => 'On','false' => 'Off'], getcong('AutoApprove'), ['class' => 'form-control'])  !!}

                            <span class="help-block">Non-admin posts will be automatically approved if this option is ON.</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Auto-approve edited posts</label>
                            {!! Form::select('AutoEdited', ['true' => 'On','false' => 'Off'], getcong('AutoEdited'), ['class' => 'form-control'])  !!}

                            <span class="help-block">Edited posts will be automatically approved if this option is ON.</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Auto-Load on Lists</label>
                            {!! Form::select('AutoLoadLists', ['true' => 'Yes','false' => 'No - Use load more button'], getcong('AutoLoadLists'), ['class' => 'form-control'])  !!}
                            <span class="help-block">You may want to use Auto-Load on the homepage lists and posts page "You may also like" posts.</span>
                        </div>
                        <hr>

                        <H3>User Permissions</H3>
                        <div class="form-group">
                            <label>
                                Users can delete own posts?
                            </label>
                            {!! Form::select('UserDeletePosts', ['true' => 'Yes','false' => 'No'], getcong('UserDeletePosts'), ['class' => 'form-control'])  !!}

                        </div>
                        <div class="form-group">
                            <label>
                                Users can edit own posts?
                            </label>
                            {!! Form::select('UserEditPosts', ['true' => 'Yes','false' => 'No'], getcong('UserEditPosts'), ['class' => 'form-control'])  !!}

                        </div>
                        <div class="form-group">
                            <label>
                                Users can edit own usernames?
                            </label>
                            {!! Form::select('UserEditUsername', ['true' => 'Yes','false' => 'No'], getcong('UserEditUsername'), ['class' => 'form-control'])  !!}

                        </div>
                         <div class="form-group">
                            <label>
                                Users can edit own emails?
                            </label>
                             {!! Form::select('UserEditEmail', ['true' => 'Yes','false' => 'No'], getcong('UserEditEmail'), ['class' => 'form-control'])  !!}

                         </div>
                        <div class="form-group">
                            <label>
                                Users can add own social media addresses?
                            </label>
                            {!! Form::select('UserAddSocial', ['true' => 'Yes','false' => 'No'], getcong('UserAddSocial'), ['class' => 'form-control'])  !!}

                        </div>
                        <hr>
                        <div class="form-group">
                            <H3>
                                Use Right-to-Left Language Support?
                            </H3>
                            {!! Form::select('languagetype', ['rtl' => 'Yes', '' => 'No'], getcong('languagetype'), ['class' => 'form-control'])  !!}

                        </div>
                        <hr>

                    </div>
                </div>

            </div><!-- /.col -->

        </div><!-- /.row -->

    @elseif(Request::query('q') == 'social')

        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Social Media</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label"><a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>  Page Url</label>
                            <div class="controls">
                                <input type="text" class="form-control input-lg" name="facebookpage" value="{{  getcong('facebookpage') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>  Page Url</label>
                            <div class="controls">
                                <input type="text" class="form-control input-lg" name="twitterpage" value="{{  getcong('twitterpage') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><a class="btn btn-social-icon btn-google"><i class="fa fa-google-plus"></i></a> Page Url</label>
                            <div class="controls">
                                <input type="text" class="form-control input-lg" name="googlepage" value="{{  getcong('googlepage') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a> Page Url</label>
                            <div class="controls">
                                <input type="text" class="form-control input-lg" name="instagrampage" value="{{  getcong('instagrampage') }}">
                            </div>
                        </div>


                        <hr>

                    </div>
                </div>

            </div><!-- /.col -->

        </div><!-- /.row -->

  @elseif(Request::query('q') == 'email')

        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Email Settings</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label">Site email</label>
                            <div class="controls">
                                <input type="text" class="form-control input-lg" name="siteemail" value="{{  getcong('siteemail') }}">
                            </div>
                            <span class="help-block">For email sending.</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>  Page Url</label>
                            <div class="controls">
                                <input type="text" class="form-control input-lg" name="twitterpage" value="{{  getcong('twitterpage') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><a class="btn btn-social-icon btn-google"><i class="fa fa-google-plus"></i></a> Page Url</label>
                            <div class="controls">
                                <input type="text" class="form-control input-lg" name="googlepage" value="{{  getcong('googlepage') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a> Page Url</label>
                            <div class="controls">
                                <input type="text" class="form-control input-lg" name="instagrampage" value="{{  getcong('instagrampage') }}">
                            </div>
                        </div>


                        <hr>

                    </div>
                </div>

            </div><!-- /.col -->

        </div><!-- /.row -->


    @elseif(Request::query('q') == 'layout')
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Layout Configuration</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Site Layout Type:</label>
                            {!! Form::select('LayoutType', ['mode-wide' => 'Wide','mode-boxed' => 'Boxed'], getcong('LayoutType'), ['class' => 'form-control'])  !!}

                        </div>
                        <div class="form-group">
                            <label>Navbar Type:</label>
                            {!! Form::select('NavbarType', ['navbar-fixed' => 'Fixed','mode-relative' => 'Relative'], getcong('NavbarType'), ['class' => 'form-control'])  !!}

                        </div>
                        <hr>
                        <div class="form-group">
                            <label>Site Background Color:</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="BodyBC" class="form-control" value="{{  getcong('BodyBC') }}">
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('BodyBC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Site Background Color On Boxed Mode:</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="BodyBCBM" class="form-control" value="{{  getcong('BodyBCBM') }}">
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('BodyBCBM') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <hr>
                        <div class="form-group">
                            <label>Navbar Background Color:</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarBC" class="form-control" value="{{  getcong('NavbarBC') }}">
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarBC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Navbar Top 3 Pixel Border Line Color:</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarTBLC" class="form-control" value="{{  getcong('NavbarTBLC') }}">
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarTBLC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Navbar Link Color:</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarLC" class="form-control" value="{{  getcong('NavbarLC') }}">
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarLC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Navbar Link Hover Color:</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarLHC" class="form-control" value="{{  getcong('NavbarLHC') }}">
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarLHC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Navbar Create <U>Button Background</U> Color:</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarCBBC" class="form-control" value="{{  getcong('NavbarCBBC') }}">
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarCBBC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Navbar Create <U>Button Font</U> Color:</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarCBFC" class="form-control" value="{{  getcong('NavbarCBFC') }}">
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarCBFC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Navbar Create <U>Button Hover Background</U> Color:</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarCBHBC" class="form-control" value="{{  getcong('NavbarCBHBC') }}">
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarCBHBC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>Navbar Create <U>Button Hover Font</U> Color:</label>
                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" name="NavbarCBHFC" class="form-control" value="{{  getcong('NavbarCBHFC') }}">
                                <div class="input-group-addon">
                                    <i style="background-color: {{  getcong('NavbarCBHFC') }};"></i>
                                </div>
                            </div><!-- /.input group -->
                        </div>
                        <hr>

                    </div>
                </div>

            </div><!-- /.col -->

        </div><!-- /.row -->
@else
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="panel panel-success">
                <div class="panel-heading">Main Configuration</div>
                <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label">Site Name</label>
                            <div class="controls">
                                <input type="text" class="form-control input-lg" name="sitename" value="{{  getcong('sitename') }}" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="sitelogo">Site Logo</label>
                                    <input type="file" id="sitelogo" name="sitelogo">
                                    <p class="help-block">Upload a site logo here. (Only PNG)</p>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <img class="field-image-preview img-thumbnail " width="150" src="{{ asset('assets/img/logo.png') }}">
                            </div>
                        </div>
                    <hr>
                    <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="footerlogo">Footer Site Logo</label>
                                    <input type="file" id="footerlogo" name="footerlogo">
                                    <p class="help-block">Upload a footer site logo here. (Only PNG)</p>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <img class="field-image-preview img-thumbnail" src="{{ asset('assets/img/flogo.png') }}">
                            </div>

                        </div>  <hr>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="favicon">Site Favicon</label>
                                    <input type="file" id="favicon" name="favicon">
                                    <p class="help-block">Upload a favicon here. (Only PNG)</p>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <img class="field-image-preview img-thumbnail " width="40" src="{{ asset('assets/img/favicon.png') }}">
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="control-label">Site Default Meta Title</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="sitetitle" value="{{  getcong('sitetitle') }}" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Site Default Meta Description</label>
                            <div class="controls">
                                <input type="text" class="form-control" name="sitemetadesc" value="{{  getcong('sitemetadesc') }}" required="required">
                            </div>
                        </div>
                <hr>
                    <div class="form-group">
                        <label class="control-label">Terms of Use Page Url</label>
                        <div class="controls">
                            <input type="text" class="form-control input-lg" name="termspage" value="{{  getcong('termspage') }}">
                        </div>
                        <span class="help-block">For register forms.</span>
                    </div>
                    <hr>

                    <hr>
                    <div class="form-group">
                        <label class="control-label">Site Language&Country Codes</label>
                        <div class="controls">
                            <input type="text" class="form-control input-lg" name="sitelanguage" value="{{  getcong('sitelanguage') }}">
                        </div>
                        <span class="help-block">For example: en_US, en_EN, de_DE, tr_TR. For more info please checkout <a href="http://www.w3schools.com/tags/ref_language_codes.asp" target="_blank">Language Codes</a>, <a  target="_blank" href="http://www.w3schools.com/tags/ref_country_codes.asp">Country Codes</a>. </span>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label">Google Font Config</label>
                        <div class="controls">
                            <input type="text" class="form-control input-lg" name="googlefont" value="{{  getcong('googlefont') }}">
                        </div>
                        <span class="help-block">Change Google Font Here. Find your perfect font on <a href="https://www.google.com/fonts" target="_blank">Google Fonts</a>. </span>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label">Site Font </label>
                        <div class="controls">
                            <input type="text" class="form-control input-lg" name="sitefontfamily" value="{{  getcong('sitefontfamily') }}">
                        </div>
                        <span class="help-block">Set your site font family. </span>
                    </div>
                </div>
            </div>

        </div><!-- /.col -->

    </div><!-- /.row -->
    <div class="row">

        <div class="col-md-6 col-lg-6">

            <div class="panel panel-info">
                <div class="panel-heading">Login Configuration</div>
                <div class="panel-body form-horizontal">
                    <legend><a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a> Facebook</legend>
                    <div class="form-group">
                        <label for="facebookapp" class="col-sm-2 control-label">App ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="facebookapp" name="facebookapp" value="{{ getcong('facebookapp') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="facebookappsecret" class="col-sm-2 control-label">App SECRET</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="facebookappsecret" name="facebookappsecret" value="{{  \Auth::user()->email == 'demo@admin.com' ?  "-YOU DO'NT HAVE PERMISSION TO SEE THAT-" : getcong('facebookappsecret')  }}">
                        </div>
                    </div>
                    <br><br>
                    <legend><a class="btn btn-social-icon btn-google"><i class="fa fa-google-plus"></i></a> Google</legend>
                    <div class="form-group">
                        <label for="googleapp" class="col-sm-2 control-label">App ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="googleapp" name="googleapp" value="{{  getcong('googleapp') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="googleappsecret" class="col-sm-2 control-label">App SECRET</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="googleappsecret" name="googleappsecret" value="{{  \Auth::user()->email == 'demo@admin.com' ?  "-YOU DO'NT HAVE PERMISSION TO SEE THAT-" : getcong('googleappsecret')  }}">
                        </div>
                    </div>
                    <br><br>
                    <legend><a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a> Twitter</legend>
                    <div class="form-group">
                        <label for="twitterapp" class="col-sm-2 control-label">App ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="twitterapp" name="twitterapp" value="{{  getcong('twitterapp') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="twitterappsecret" class="col-sm-2 control-label">App SECRET</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="twitterappsecret" name="twitterappsecret" value="{{  \Auth::user()->email == 'demo@admin.com' ?  "-YOU DO'NT HAVE PERMISSION TO SEE THAT-" : getcong('twitterappsecret')  }}">
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">

        <div class="col-md-6 col-lg-6">

            <div class="panel panel-danger">
                <div class="panel-heading">Advanced Configuration</div>
                <div class="panel-body form-horizontal">
                    <legend>Head Code</legend>
                    <textarea name="headcode" style="height:120px" class="form-control">{{  getcong('headcode') }}</textarea>
                    <span class="help-block">You may want to add some html/css/js code to head. For example custom css. Google verification code or other meta tags etc.</span>
                    <br>
                    <legend>Footer code</legend>
                    <textarea name="footercode" style="height:120px" class="form-control">{{  getcong('footercode') }}</textarea>
                    <span class="help-block">You may want to add some html/css/js code to footer. For Example Google Analytics code etc.</span>

                </div>
            </div>

        </div><!-- /.col -->
    </div><!-- /.row -->

@endif
    <div class="row">
        <div class="col-md-6 col-lg-6">

            <input type="submit" value="Save Settings" class="btn btn-block btn-info btn-lg">

        </div><!-- /.col -->
    </div><!-- /.row -->
    {!! Form::close() !!}
</section>
@endsection
@section("footer")
    <script src="/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="/adminlte/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            //iCheck for checkbox and radio inputs
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            //Colorpicker
            $(".my-colorpicker1").colorpicker();
            //color picker with addon
            $(".my-colorpicker2").colorpicker();

        });
    </script>
@endsection