<!DOCTYPE html>
<html lang="{{ Lang::getLocale() }}">
<head>
    <title>@yield('head_title', getcong('sitetitle'))</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('head_description', getcong('sitemetadesc'))" />

    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('head_title',  getcong('sitetitle'))" />
    <meta property="og:description" content="@yield('head_description', getcong('sitemetadesc'))" />
    <meta property="og:image" content="@yield('head_image', url('/assets/img/logo.png'))" />
    <meta property="og:url" content="@yield('head_url', url())" />

    <meta name="twitter:image" content="@yield('head_image', url('/assets/img/logo.png'))" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="@yield('head_url', url())">
    <meta name="twitter:title" content="@yield('head_title',  getcong('sitetitle'))">
    <meta name="twitter:description" content="@yield('head_description', getcong('sitemetadesc'))">

    <link href='https://fonts.googleapis.com/css?family={{  getcong('googlefont') }}' rel='stylesheet' type='text/css'>
    <link href="{{ url('/assets/img/favicon.png') }}" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/plugins.css">
    <link rel="stylesheet" href="/assets/css/application.css">
	<link rel="stylesheet" href="/assets/css/component.css">
	<link rel="stylesheet" href="/assets/css/jquery.bxslider.css">
    <link rel="stylesheet" href="/assets/css/linkPreview.css">
    <link rel="stylesheet" href="/assets/css/stylesheet.css">

    {{--<link href="assets/css/jquery.fileupload-ui.css" media="screen" rel="stylesheet" type="text/css" />--}}
    {{--<link href="assets/css/jquery.fileupload-ui-kaltura.css" media="screen" rel="stylesheet" type="text/css" />--}}

    <style type="text/css">
        body {
            font-family: {!!    getcong('sitefontfamily') !!};
            background: {{  getcong('BodyBC') }}!important;}
        body.mode-boxed {
            background: {{  getcong('BodyBCBM') }}!important; }
        header {
            background: {{ getcong('NavbarBC') }}!important;
            border-top: 3px solid {{ getcong('NavbarTBLC') }}!important;}
        .header  a{
            color: {{ getcong('NavbarLC') }}!important;}
        .header a > i{
            color: {{ getcong('NavbarLC') }}!important;}
        .header .navmenu li.active >a,
        .header .navmenu li:hover >a{
             border-color: {{ getcong('NavbarTBLC') }}!important;
         }
        .header a:hover{
            color: {{ getcong('NavbarLHC') }}!important;}
        .header a:hover > i{
            color: {{ getcong('NavbarLHC') }}!important;}
        .header .create-links > a {
            background: {{ getcong('NavbarCBBC') }}!important;
            color: {{ getcong('NavbarCBFC') }}!important;
            border-color: {{ getcong('NavbarCBBC') }}!important;}
        .header .create-links > a i {
            color: {{ getcong('NavbarCBFC') }}!important;}
        .header .create-links > a:hover {
            background: {{ getcong('NavbarCBHBC') }}!important;
            color: {{ getcong('NavbarCBHFC') }}!important;}
        .header .create-links > a:hover i {
            color: {{ getcong('NavbarCBHFC') }}!important;}
        .list-count:before {
            background: {{ getcong('NavbarTBLC') }}!important;}
    </style>

    {!! getcong('headcode') !!}

    @yield("header")

</head>
<?php $DB_USER_LANG = isset($DB_USER_LANG) ? $DB_USER_LANG : '' ?>
<body class="  {{ getcong('languagetype') }} {{ \Config::get('app.language.'.$DB_USER_LANG)['rtl'] ? 'rtl' :''  }} {{ \Config::get('app.language.'.\Session::get ('locale'))['wideheader'] ? 'widecontainer' : ''  }}  {{ getcong('LayoutType') }} {{ getcong('NavbarType') }} @if(!Request::is('/')) mode-default @endif @if(Request::is('create') or Request::segment(1)=='profile' or Request::segment(1)=='edit') mode-boxed @endif">

@if (empty($noheader))
    @include("_particles.header")
@endif


<div class="content-wrapper" id="container-wrapper">
    @if(!Request::is('create') ) @if(Request::segment(1)!=='profile') @if(Request::segment(1)!=='edit')
            @foreach(\App\Widgets::where('type', 'HeaderBelow')->where('display', 'on')->get() as $widget)
                <div class="content">
                    <div class="container" style="text-align: center;padding-top:20px;padding-bottom:20px ">
                        <center>
                         {!! $widget->text !!}
                        </center>
                    </div>
                </div>
            @endforeach
    @endif @endif @endif
    @yield("content")

</div>

@include("_particles.footer")

<div id="fb-root"></div>
<script src="/assets/js/plugins.js"></script>
<script src="/assets/js/app.min.js"></script>
<link href="/urlpreview/jquery.urlive.css" rel="stylesheet" type="text/css">
<script src="/urlpreview/jquery.urlive.js"></script>
<script src="/assets/js/custom-file-input.js"></script>
<script src="{{ asset('assets/js/jquery.cookies.js') }}"></script>
<script src="{{ asset('assets/js/jquery.bxslider.js') }}"></script>
<script src="{{ asset('assets/js/linkPreview.js') }}"></script>
<script src="{{ asset('assets/js/linkPreviewRetrieve.js') }}"></script>

{{--<script type="text/javascript" src="assets/js/jquery.ui.widget.js"></script>--}}
{{--<script type="text/javascript" src="assets/js/webtoolkit.md5.js"></script>--}}
{{--<script type="text/javascript" src="assets/js/jquery.iframe-transport.js"></script>--}}
{{--<script type="text/javascript" src="assets/js/jquery.fileupload.js"></script>--}}
{{--<script type="text/javascript" src="assets/js/jquery.fileupload-process.js"></script>--}}
{{--<script type="text/javascript" src="assets/js/jquery.fileupload-validate.js"></script>--}}
{{--<script type="text/javascript" src="assets/js/jquery.fileupload-kaltura.js"></script>--}}
{{--<script type="text/javascript" src="assets/js/jquery.fileupload-kaltura-base.js"></script>--}}
<script>
    $( document ).ready(function() {
        App.init();

	$('#demo').urlive({
	 callbacks: {
	  onStart: function() {},
	  onSuccess: function() {},
	  onFail: function() {},
	  noData: function() {},
	  onLoadEnd: function() {
			//alert($('.urlive-container').html());
			$('#urlprev').val($('.urlive-container').html().trim());

	  },
	  imgError: function() {},
	  onClick: function() {}
	}
	});

        $('#retrieveFromDatabase').linkPreviewRetrieve();
        $('#lp1').linkPreview();

    });
</script>
@yield("footer")
@include('.errors.swalerror')

<div id="auth-modal" class="modal auth-modal"></div>

<div class="hide">
    <input name="_requesttoken" id="requesttoken" type="hidden" value="{{ csrf_token() }}" />
</div>

{!!  getcong('footercode')  !!}

</body>
</html>
<!-- Buzzy Media Script - All rights reserved by akbilisim. Website: www.akbilisim.com -->