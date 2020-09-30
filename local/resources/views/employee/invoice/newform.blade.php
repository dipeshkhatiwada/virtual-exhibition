@extends('admin_master')
@section('heading')
New Currency 
            <small>Detail of New Currency</small>
@stop
@section('breadcrubm')
 <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/admin/currency') }}">Currencies</a></li>
            <li class="active">New Currency</li>
@stop
@section('content')
 <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">New Currency</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/currency/save') }}">
                        {!! csrf_field() !!}
                        <div class="row">
                         <div class="col-md-10">
                        
                        
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label">Title</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('symbol') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label">Symbol</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="symbol" value="{{ old('symbol') }}">

                                @if ($errors->has('symbol'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('symbol') }}</strong>
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