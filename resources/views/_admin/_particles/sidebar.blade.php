<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{ makepreview(Auth::user()->icon, 's', 'members/avatar') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>{{  Auth::user()->username }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li @if(Request::segment(2)=='') class="active" @endif>
            <a href="{{  action('Admin\DashboardController@index') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        @if(getcong('p-buzzycontact') == 'on')
        <li class=" @if(Request::segment(2)=='mailbox') active @endif">
            <a href="{{  action('Admin\ContactController@index') }}">
                <i class="fa fa-envelope"></i> <span>Inbox</span>
                @if($unapproveinbox >0)
                <span class="pull-right badge bg-green">{{ $unapproveinbox }}</span>
                @endif
            </a>
        </li>
        @endif
        <li @if(Request::segment(2)=='plugins') class="active" @endif>
            <a href="{{  action('Admin\DashboardController@plugins') }}">
                <i class="fa fa-puzzle-piece"></i> <span>Plugins</span>
                <span class="pull-right badge bg-red">NEW</span>

            </a>
        </li>
        <li class="treeview  @if(Request::segment(2)=='config') active @endif">
            <a href="{{ action('Admin\ConfigController@index') }}">
                <i class="fa fa-cog"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ action('Admin\ConfigController@index') }}"><i class="fa fa-caret-right"></i> General Settings</a></li>
                <li><a href="{{ action('Admin\ConfigController@index', ['q' => 'layout']) }}"><i class="fa fa-caret-right"></i> Layout Settings</a></li>
                <li><a href="{{ action('Admin\ConfigController@index', ['q' => 'social']) }}"><i class="fa fa-caret-right"></i> Social Media Settings</a></li>
                <li><a href="{{ action('Admin\ConfigController@index', ['q' => 'others']) }}"><i class="fa fa-caret-right"></i> Other Settings</a></li>
            </ul>
        </li>
        <li @if(Request::segment(2)=='categories') class="active" @endif>
            <a href="{{  action('Admin\CategoriesController@index') }}">
                <i class="fa fa-folder"></i>
                <span>Categories</span>
            </a>
        </li>
        <li class=" @if(Request::segment(2)=='all') active @endif">
            <a href="/admin/all/">
                <i class="fa fa-book"></i>
                <span>Latest Posts</span>
            </a>
        </li>
        <li class=" @if(Request::segment(2)=='features') active @endif">
            <a href="/admin/features/">
                <i class="fa fa-star"></i>
                <span>Features Posts</span>
            </a>
        </li>
        <li class="treeview  @if(Request::segment(2)=='unapprove') active @endif">
            <a href="/admin/unapprove?only=unapprove">
                <i class="fa fa-check-circle"></i>
                <span>Unapproved Posts</span>
                <small class="label pull-right bg-aqua">{{ $toplamapprove }}</small>
            </a>
        </li>
        @if($DB_PLUGIN_NEWS == 'on')
        <li class="treeview  @if(Request::segment(2)=='news') active @endif">
            <a href="/admin/news">
                <i class="fa fa-file-text"></i>
                <span>News</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="/admin/news"><i class="fa fa-eye"></i> View News</a></li>
                <li><a href="/admin/news/?only=unapprove"><i class="fa fa-check-circle"></i> Unapproved News <small class="label pull-right bg-aqua">{{ $napprovenews }}</small></a></li>
                <li><a href="/admin/news/?only=deleted"><i class="fa fa-trash-o"></i> News Trash</a></li>
            </ul>
        </li>
        @endif
        @if($DB_PLUGIN_LISTS == 'on')
        <li class="treeview @if(Request::segment(2)=='lists') active @endif">
            <a href="/admin/lists">
                <i class="fa fa-th-list"></i>
                <span>Lists</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="/admin/lists"><i class="fa fa-eye"></i> View Lists</a></li>
                <li><a href="/admin/lists/?only=unapprove"><i class="fa fa-check-circle"></i> Unapproved Lists <small class="label pull-right bg-green">{{ $napprovelists }}</small></a></li>
                <li><a href="/admin/lists/?only=deleted"><i class="fa fa-trash-o"></i> List Trash</a></li>
            </ul>
        </li>
        @endif
        @if($DB_PLUGIN_QUIZS == 'on')
        <li class="treeview @if(Request::segment(2)=='quizzes') active @endif">
            <a href="/admin/quizzes">
                <i class="fa fa-question-circle"></i>
                <span>Quizzes</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="/admin/quizzes"><i class="fa fa-eye"></i> View Quizzes</a></li>
                <li><a href="/admin/quizzes/?only=unapprove"><i class="fa fa-check-circle"></i> Unapproved Quizzes <small class="label pull-right bg-purple">{{ $unapprovequizzes }}</small></a></li>
                <li><a href="/admin/quizzes/?only=deleted"><i class="fa fa-trash-o"></i> Quiz Trash</a></li>
            </ul>
        </li>
        @endif
        @if($DB_PLUGIN_POLLS == 'on')
            <li class="treeview @if(Request::segment(2)=='polls') active @endif">
                <a href="/admin/polls">
                    <i class="fa fa-check-square-o"></i>
                    <span>Polls</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/polls"><i class="fa fa-eye"></i> View Polls</a></li>
                    <li><a href="/admin/polls/?only=unapprove"><i class="fa fa-check-circle"></i> Unapproved Polls <small class="label pull-right bg-red">{{ $napprovepolls }}</small></a></li>
                    <li><a href="/admin/polls/?only=deleted"><i class="fa fa-trash-o"></i> Poll Trash</a></li>
                </ul>
            </li>
        @endif
        @if($DB_PLUGIN_VIDEOS == 'on')
        <li class="treeview  @if(Request::segment(2)=='videos') active @endif">
            <a href="/admin/videos">
                <i class="fa fa-youtube-play"></i>
                <span>Videos</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="/admin/videos"><i class="fa fa-eye"></i> View Videos</a></li>
                <li><a href="/admin/videos/?only=unapprove"><i class="fa fa-check-circle"></i> Unapproved Videos <small class="label pull-right bg-yellow">{{ $napprovevideos }}</small></a></li>
                <li><a href="/admin/videos/?only=deleted"><i class="fa fa-trash-o"></i> Video Trash</a></li>
            </ul>
        </li>
        @endif
        <li class="treeview @if(Request::segment(2)=='users') active @endif">
            <a href="users">
                <i class="fa fa-users"></i>
                <span>Users</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="/admin/users"><i class="fa fa-caret-right"></i> View Users</a></li>
                <li><a href="/admin/users/?only=banned"><i class="fa fa-caret-right"></i> Banned Users </a></li>
                <li><a href="/admin/users/?only=admins"><i class="fa fa-caret-right"></i> Admins</a></li>
                <li><a href="/admin/users/?only=staff"><i class="fa fa-caret-right"></i> Staff</a></li>
            </ul>
        </li>

        <li class="treeview  @if(Request::segment(2)=='pages') active @endif">
            <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Pages</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ action('Admin\PagesController@index') }}"><i class="fa fa-caret-right"></i> View Pages</a></li>
                <li><a href="{{ action('Admin\PagesController@add') }}"><i class="fa fa-caret-right"></i> Add New Page</a></li>
            </ul>
        </li>
        <li class="treeview  @if(Request::segment(2)=='widgets') active @endif">
            <a href="{{ action('Admin\WidgetsController@index') }}">
                <i class="fa fa-plus-square"></i>
                <span>Widgets</span>
            </a>
        </li>
        <li class="treeview">
            <a href="/sitemap.xml" target="_blank">
                <i class="fa fa-rss"></i>
                <span>Sitemap</span>
            </a>
        </li>
        <li>
            <a href="/admin/docs/">
                <i class="fa fa-book"></i>
                <span> Documentation</span>
            </a>
        </li>
        <li class="header">UNAPPROVED POSTS</li>
        @if($DB_PLUGIN_NEWS == 'on')<li><a href="/admin/news/?only=unapprove"><i class="fa fa-circle-o text-aqua"></i> <span>News</span><small class="label pull-right bg-aqua">{{ $napprovenews }}</small></a></li> @endif
        @if($DB_PLUGIN_LISTS == 'on')<li><a href="/admin/lists/?only=unapprove"><i class="fa fa-circle-o text-green"></i> <span>Lists</span><small class="label pull-right bg-green">{{ $napprovelists }}</small></a></li> @endif
        @if($DB_PLUGIN_QUIZS == 'on')<li><a href="/admin/quizzes/?only=unapprove"><i class="fa fa-circle-o text-purple"></i> <span>Quizzes</span><small class="label pull-right bg-purple">{{ $unapprovequizzes }}</small></a></li> @endif
        @if($DB_PLUGIN_VIDEOS == 'on')<li><a href="/admin/polls/?only=unapprove"><i class="fa fa-circle-o text-yellow"></i> <span>Polls</span><small class="label pull-right bg-yellow">{{ $napprovepolls }}</small></a></li> @endif
        @if($DB_PLUGIN_POLLS == 'on')<li><a href="/admin/videos/?only=unapprove"><i class="fa fa-circle-o text-red"></i> <span>Videos</span><small class="label pull-right bg-red">{{ $napprovevideos }}</small></a></li> @endif
    </ul>
</section>