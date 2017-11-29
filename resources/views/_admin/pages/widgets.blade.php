@extends("_admin.adminapp")
@section("content")
        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Widgets
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Widgets</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-7">
            @if(count($PostPageSidebar) != 0)
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Post Page Sidebar</h3>
                    </div><!-- /.box-header -->
                    <?php $i=0; ?>
                    <div class="box-body" style="padding:20px">
                        @foreach($PostPageSidebar as $i => $widget)
                            @include('_admin._particles.widget_list')
                        @endforeach
                    </div><!-- /.box-header -->
                </div>
            @endif
            @if(count($CategoriesPageSidebar) != 0)
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Categories Page Sidebar</h3>
                    </div><!-- /.box-header -->
                    <?php $i=0; ?>
                    <div class="box-body" style="padding:20px">
                        @foreach($CategoriesPageSidebar as $i => $widget)
                            @include('_admin._particles.widget_list')
                        @endforeach
                    </div><!-- /.box-header -->
                </div>
            @endif

            @if(count($HeaderBelow) != 0)
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Header Below</h3>
                    </div><!-- /.box-header -->
                    <?php $i=0; ?>
                    <div class="box-body" style="padding:20px">
                        @foreach($HeaderBelow as $i => $widget)
                            @include('_admin._particles.widget_list')
                        @endforeach
                    </div><!-- /.box-header -->
                </div>
            @endif
            @if(count($PostBelow) != 0)
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Post Below</h3>
                    </div><!-- /.box-header -->
                    <?php $i=0; ?>
                    <div class="box-body" style="padding:20px">
                        @foreach($PostBelow as $i => $widget)
                            @include('_admin._particles.widget_list')
                        @endforeach
                    </div><!-- /.box-header -->
                </div>
            @endif
            @if(count($PostBetween2nd3rdentry) != 0)
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Post Page: Between 2nd 3rd entry</h3>
                    </div><!-- /.box-header -->
                    <?php $i=0; ?>
                    <div class="box-body" style="padding:20px">
                        @foreach($PostBetween2nd3rdentry as $i => $widget)
                            @include('_admin._particles.widget_list')
                        @endforeach
                    </div><!-- /.box-header -->
                </div>
            @endif

                @if(count($Homencolfirst) != 0)
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">HomePage First(List) Column - 1. Post Below</h3>
                    </div><!-- /.box-header -->
                    <?php $i=0; ?>
                    <div class="box-body" style="padding:20px">
                        @foreach($Homencolfirst as $i => $widget)
                            @include('_admin._particles.widget_list')
                        @endforeach
                    </div><!-- /.box-header -->
                </div>
            @endif
                @if(count($Homencolsec) != 0)
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">HomePage Second(News) Column - 1. Post Below</h3>
                        </div><!-- /.box-header -->
                        <?php $i=0; ?>
                        <div class="box-body" style="padding:20px">
                            @foreach($Homencolsec as $i => $widget)
                                @include('_admin._particles.widget_list')
                            @endforeach
                        </div><!-- /.box-header -->
                    </div>
                @endif
                @if(count($PostShareBw) != 0)
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Post Pages Share Below</h3>
                        </div><!-- /.box-header -->
                        <?php $i=0; ?>
                        <div class="box-body" style="padding:20px">
                            @foreach($PostShareBw as $i => $widget)
                                @include('_admin._particles.widget_list')
                            @endforeach
                        </div><!-- /.box-header -->
                    </div>
                @endif

            @if(count($Footer) !== 0)
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Footer</h3>
                    </div><!-- /.box-header -->
                    <?php $i=0; ?>
                    <div class="box-body" style="padding:20px">
                        @foreach($Footer as $i => $widget)
                            @include('_admin._particles.widget_list')
                        @endforeach
                    </div><!-- /.box-header -->
                </div>
            @endif


        </div><!-- /.col -->
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ isset($widgeta->key) ? 'Edit: '.$widgeta->key : 'Add Widget' }}</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(array('action' => array('Admin\WidgetsController@addnew'), 'method' => 'POST')) !!}
                <div class="box-body" style="padding:20px">
                    <input type="hidden" name="id" value="{{ isset($widgeta->id) ? $widgeta->id : null }}">
                    <div class="form-group">
                        {!! Form::label('key','Widget Name') !!}
                        {!! Form::text('key',  isset($widgeta->key) ? $widgeta->key : null, ['id' => 'name', 'class' => 'form-control input-lg', 'placeholder' => 'Widget name']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('text','Paste Html Content / Adsense Code / Social Media Embeds here') !!}
                        {!! Form::textarea('text', isset($widgeta->text) ? $widgeta->text : null, [ 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('type','Location') !!}
                        {!! Form::select('type', [
                        'PostPageSidebar' => 'Post Page Sidebar',
                        'CatSide' => 'Categories Page Sidebar',
                        'HeaderBelow' => 'Header Below',
                        'PostBelow' => 'Post Below',
                         'PostShareBw' => 'Post Pages Share Below',
                        'Post2nd3rdentry' => 'Post Page: Between 2nd 3rd entry',
                        'Homencolfirst' => 'HomePage First(List) Column - 1. Post Below',
                        'Homencolsec' => 'HomePage Second(News) Column - 1. Post Below',
                        'Footer' => 'Footer',
                        ], isset($widgeta->type) ? $widgeta->type : null , ['class' => 'form-control'])  !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('display','Display') !!}
                        {!! Form::select('display', ['on' => 'On','off' => 'Off'], isset($widgeta->display) ? $widgeta->display : null , ['class' => 'form-control'])  !!}
                    </div>

                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/admin/widgets" class="btn btn-default pull-right">Cancel</a>
                </div>
                {!! Form::close() !!}

            </div>

        </div><!-- /.col -->

    </div><!-- /.row -->

</section>
@endsection
@section("footer")
        <!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
      // CKEDITOR.replace( 'text', {
      //      fullPage: true,
      //     allowedContent: true
      //  });
    });
</script>
@endsection