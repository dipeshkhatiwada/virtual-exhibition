@extends('admin_master')
@section('heading')
No Permission
            <small>Permission Denied</small>
@stop
@section('breadcrubm')
 <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            
            <li class="active">Permission Denied</li>
@stop
@section('content')
 <div class="row">
    <div class="col-xs-12">
      
     
    <div class="alert alert-danger">Sorry ! You Dont have Permission to Access This page</div>
      
     
      
    </div>
  <div>

  <div>
  </div>
  
  
@stop()