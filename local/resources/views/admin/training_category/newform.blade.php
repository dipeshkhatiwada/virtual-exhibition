@extends('admin_master')
@section('heading')
New Training Category 
            <small>Detail of New Training Category</small>
@stop
@section('breadcrubm')
 <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/admin/training_category') }}">Training Categorys</a></li>
            <li class="active">New Training Category</li>
@stop
@section('content')
 <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">New Training Category</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/training_category/save') }}">
                        {!! csrf_field() !!}
                        <div class="row">
                         <div class="col-md-10">
                        
                        
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label">Title</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('seo_url') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label">Seo Url</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" id="seo_url" name="seo_url" value="{{ old('seo_url') }}">

                                @if ($errors->has('seo_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('seo_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        

                    </div>
                </div>
                  
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-save"></i>Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 <script type="text/javascript">
         $('#title').blur(function(){
        var data = $(this).val();
        var se_url = data.replace(/ /g,"-");
        $('#seo_url').val(se_url);
    });
    </script>
@endsection