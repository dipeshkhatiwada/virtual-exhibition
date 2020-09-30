@extends('admin_master')
@section('heading')
New Layout
<small>Detail of New Layout</small>
@stop
@section('breadcrubm')
<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li><a href="{{ url('/admin/language') }}">Layout</a></li>
<li class="active">New Language</li>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">New layout</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/layout/save') }}">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-10">
                                
                                
                                <div class="form-group{{ $errors->has('layout_title') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label">Layout Title</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="layout_title" value="{{ old('layout_title') }}">
                                        @if ($errors->has('layout_title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('layout_title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('route') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label">Layout Route</label>
                                    <div class="col-md-10">
                                        <select name="route" id="route" class="form-control" >
                                            
                                            <option value="Article">Article Page </option>
                                            <option value="Home">Home Page </option>
                                            <option value="Jobs">Jobs </option>
                                            
                                            <option value="Employer">Employer </option>
                                            
                                            <option value="AlbumGallery">Album Gallery </option>
                                            
                                            <option value="Contact">Contact</option>
                                            
                                            <option value="Events">Events</option>
                                            <option value="EventDetail">Event Detail</option>
                                            <option value="EventEmployer">Organization Events</option>
                                            <option value="EventSearch">Event Search</option>
                                            
                                            
                                            
                                            <option value="MultipleArticle">Multiple Article </option>
                                            <option value="PhotoGallery">Photo Gallery </option>
                                            
                                            <option value="Search">Search</option>
                                            <option value="Projects">Projects</option>
                                            <option value="ProjectDetail">Project Detail</option>
                                            <option value="ProjectEmployer">Organization Projects</option>
                                            <option value="ProjectSearch">Project Search</option>
                                            <option value="ProjectTag">ProjectSkills</option>
                                            
                                            <option value="SingleArticle">Single Article </option>
                                            <option value="Tenders">Tender </option>
                                            <option value="TendersEmployers">Tender Employer</option>
                                            <option value="TendersCategory">Tender Category</option>
                                            <option value="TendersDetail">Tender Detail</option>
                                            <option value="Testimonial">Testimonials </option>
                                            <option value="TestimonialDisplay">Testimonial Display </option>

                                            <option value="Trainings">Trainings</option>
                                            <option value="TrainingDetail">Training Detail</option>
                                            <option value="TrainingEmployer">Organization Trainings</option>
                                            <option value="TrainingSearch">Training Search</option>
                                            
                                            
                                            <option value="VideoGallery">Video Gallery</option>
                                            <option value="VideoDisplay">Video Display </option>
                                            <option value="Job">Job </option>
                                            <option value="Vacancy">Vacancy </option>
                                            
                                            <option value="WomenIndex">Women Index </option>
                                            <option value="WomenBlog">Women Blog </option>
                                            <option value="WomenBlogDetail">Women Blog Detail </option>
                                            

                                            <option value="AbleIndex">Able Index </option>
                                            <option value="AbleBlog">Able Blog </option>
                                            <option value="AbleBlogDetail">Able Blog Detail </option>

                                            <option value="RetairedIndex">Retaired Index </option>
                                            <option value="RetairedBlog">Retaired Blog </option>
                                            <option value="RetairedBlogDetail">Retaired Blog Detail </option>
                                            
                                            
                                            
                                        </select>
                                        @if ($errors->has('route'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('route') }}</strong>
                                        </span>
                                        @endif
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