@extends('admin_master')
@section('heading')
Virtual Exhibition
<small>Add Exhibition Category</small>
@stop
@section('breadcrubm')
<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

<li class="active">Enroll</li>
@stop
@section('content')
<script src="{{asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/dist/css/jquery-ui.css')}}">
<script src="{{asset('assets/dist/js/jquery-ui.js')}}"></script>
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">New Virtual Exhibition Category</div>
                <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab-content">
                                        <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="{{route('enroll.addCategory', $category->enroll->id)}}">
                                            @csrf
                                            <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
                                                <div class="col-md-6">
                                                    <label class="required">Exhibition Type</label>
                                                    <input type="hidden" name="idType" value="{{ $category->enroll->id }}">
                                                    <input type="text" id="vtype"  name="vtype" class="form-control" value="{{ $category->enroll->title }}" disabled>
                                                    @if ($errors->has('title'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row {{ $errors->has('category_title') ? ' has-error' : '' }}">
                                                <div class="col-md-3">
                                                    <label class="required">Category</label>
                                                    <input type="text" class="form-control" id="category_title" name="category_title" placeholder="Category of Exhibition" >
                                                    @if ($errors->has('category_title'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('category_title') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="col-md-3 {{ $errors->has('seo_url') ? ' has-error' : '' }}">
                                                    <label class="required">Seo Url</label>
                                                    <input type="text" class="form-control" id="seo_url" name="seo_url">
                                                    @if ($errors->has('seo_url'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('seo_url') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row {{ $errors->has('seat_limit') ? ' has-error' : '' }}">
                                                <div class="col-md-3">
                                                    <label class="required">Seat Limit</label>
                                                    <input type="number" class="form-control" id="seat_limit" name="seat_limit" placeholder="Seat Available">
                                                    @if ($errors->has('seat_limit'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('seat_limit') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                <button type="submit" class="btn sendbtn bluebg">Add Category <i class="fab fa-telegram"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#category_title').blur(function(){
var data = $(this).val();
var se_url = data.replace(/ /g,"-");
$('#seo_url').val(se_url);
});
</script>
@endsection
