

<div class="clear"></div>
<footer class="footer">
    <div class="container" style="border:0 ; box-shadow: none;">
        <div class="row">

            <div class="col-1" style="text-align: right">
                <img class="site-logo" src="/assets/img/flogo.png" alt="">
                @if(!empty(\Config::get('app.language')))
                    <div class="language-links hor">
                        <a class="button button-white" href="javascript:">
                            <i class="fa fa-globe"></i> <b>{{ \Config::get('app.language.'.$DB_USER_LANG)['name']  }}</b>
                        </a>
                        <ul class="sub-nav ">
                            @foreach(\Config::get('app.language') as $key => $lang)
                            <li>
                                <a href="{{ url('/selectlanguge/'.$key) }}" class="sub-item">{{ $lang['name'] }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="col-2">

                @foreach(\App\Widgets::where('type', 'Footer')->where('display', 'on')->get() as $widget)
                      {!! $widget->text !!}
                @endforeach

            </div>
        </div>
    </div>
</footer>
