@extends('admin_master')
@section('heading')
Enroll
<small>Edit Enroll Information</small>
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
    <div class="col-xs-10">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Enroll Details</div>
                <div class="panel-body">
                <form class="form-horizontal" role="form" id="testform" method="POST" action="{{route('enroll.updateCategory', $category->id)}}">
                     @csrf
                        <div class="row">
                            <div class="col-md-10">

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Type</label>

                                    <div class="col-md-10">
                                        <input type="hidden" name="idType" value="{{ $category->enroll->id }}">
                                        <input type="text" class="form-control" name="type" value="{{ $category->enroll->title }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Category</label>

                                    <div class="col-md-10">
                                        <input type="hidden" name="idCategory" value="{{ $category->id }}">
                                        <input type="text" class="form-control" name="category" value="{{ $category->title }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Seo Url</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="seo_url" value="{{ $category->seo_url }}">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Seat Limit</label>

                                    <div class="col-md-10">
                                        <input type="number" class="form-control" name="seat_limit" value="{{ $category->seat_limit }}">

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-save"></i>Update
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
