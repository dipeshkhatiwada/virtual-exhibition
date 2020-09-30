@extends('admin_master')
@section('heading')
Event Category Detail 
            <small>Detail of Event Category</small>
@stop
@section('breadcrubm')
 <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/admin/event_category') }}">Event Categories</a></li>
            <li class="active">Edit Event Category</li>
@stop
@section('content')
 <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">Event Category Detail</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/event_category/update') }}">
                        <input type="hidden" name="id" value="<?php echo $data->id;?>" />
                        {!! csrf_field() !!}
                        <div class="row">
                         <div class="col-md-10">
                       
                        
                         <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label">Title</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="title" value="{{ $data->title }}">

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
                                <input type="text" class="form-control" name="seo_url" value="{{ $data->seo_url }}">

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
@endsection