@extends('employer_master')
@section('content')
      
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>

<div class="container">
 
   
         
                    <div class="careerfy-typo-wrap">
                         @if(count($errors))
                <div class="row">
            <div class="col-xs-12">
            <div class="alert alert-danger">
             @foreach($errors->all() as $error)
              {{ '* : '.$error }}</br>
             @endforeach
                </div>
            </div>

          </div>
       @endif
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" id="testform" method="POST" action="{{ url('/employer/blogs/update') }}">
                        <input type="hidden" name="id" id="id" value="{{$datas['article']->id}}">
                        {!! csrf_field() !!}
                        <div class="careerfy-employer-box-section">
                        <div class="careerfy-profile-title"><h2>New Blog</h2></div>
                        
                         <div class="col-md-12 ">
                                  
           
                                     <ul class="careerfy-row careerfy-employer-profile-form">
                                      <li class="careerfy-column-6 {{ $errors->has('title') ? ' has-error' : '' }}">
                                           <label class="required">Title</label>
                                            <input type="text" id="title"  name="title" value="{{ $datas['article']->title }}">

                                                @if ($errors->has('title'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                @endif
                                       </li>

                                        <li class="careerfy-column-6 {{ $errors->has('seo_url') ? ' has-error' : '' }}">
                                           <label class="required">Seo Url</label>
                                            <input type="text"  id="seo_url" name="seo_url" value="{{ $datas['article']->seo_url }}">

                                            @if ($errors->has('seo_url'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('seo_url') }}</strong>
                                                </span>
                                            @endif
                                       </li>

                                       <li class="careerfy-column-6 {{ $errors->has('meta_title') ? ' has-error' : '' }}">
                                           <label class="required">Meta Title</label>
                                            <input type="text"  id="meta_title" name="meta_title" value="{{ $datas['article']->meta_title }}">

                                            @if ($errors->has('meta_title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('meta_title') }}</strong>
                                                </span>
                                            @endif
                                       </li>
                                        <li class="careerfy-column-6">
                                           <label class="required">Meta Keyword</label>
                                            <input type="text"  id="meta_keyword" name="meta_keyword" value="{{ $datas['article']->meta_keyword }}">

                                           
                                       </li>
                                        <li class="careerfy-column-6">
                                           <label class="">Photo </label>
                                            <input type="file" name="file">
                                            @if($datas['image'] != '')
                                                <span class="edit-image"><img src="{{asset($datas['image'])}}"><span class="delete-photo" onClick="deletePhoto('{{$datas['article']->id}}')"><i class="fa fa-times"></i></span></span>
                                            @endif
                                       </li>
                                       <li class="careerfy-column-6">
                                           <label class="required">Video</label>
                                            <input type="text" name="video" value="{{$datas['article']->video}}">
                                       </li> 
                                        <li class="careerfy-column-6">
                                           <label class="">Status </label>
                                           <div class="careerfy-profile-select">
                                           <select name="status">
                                           @if($datas['article']->status == 1)
                                            <option value="1" selected="selected">Active</option>
                                             <option value="2" >Deactive</option>
                                            @else
                                             <option value="1" >Active</option>
                                             <option value="2" selected="selected">Deactive</option>
                                            @endif
                                            </select>
                                        </div>
                                       </li> 

                                       <li class="careerfy-column-12">
                                           <label class="">Meta Discription</label>
                                            <textarea name="meta_description">{{ $datas['article']->meta_description }}</textarea>
                                       </li>
                                       
                                       

                                       <li class="careerfy-column-12">
                                           
                                             <textarea id="description" name="description">{{$datas['article']->description}}</textarea>

                                            <script>
      
       
        CKEDITOR.replace('description',
    {
                  filebrowserBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html")}}',
                  filebrowserImageBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html?type=Images")}}',
                  filebrowserFlashBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html?type=Flash")}}',
                  filebrowserUploadUrl : 
'{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files")}}',
                  filebrowserImageUploadUrl : 
'{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images")}}',
                  filebrowserFlashUploadUrl : '{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash")}}',
                  enterMode: CKEDITOR.ENTER_BR
                 } 
    
    );
       
        
     
    </script>

                                       </li>

                                      
                        
                                             
                                        

                                       
                                       </ul>
               





                </div>
                      </div>
                      <input class="careerfy-employer-profile-submit ml-3 mb-3" value="Submit" type="submit">
                    </form>
                </div>
             

<?php $today = date('y'); ?>
<script type="text/javascript">
   
    $('#title').blur(function(){
        var data = $(this).val();
        
        var se_url = data.replace(/ /g,"-");
        $('#meta_title').val(data);
        $('#seo_url').val(se_url);
    });

    function deletePhoto(id)
    {
        var token = $('input[name=\'_token\']').val();
        var fname = '{{$datas["article"]->image}}';
        if (id != '') {
            $.ajax({
                type: 'POST',
                url: '{{url("/employer/blogs/deleteimage")}}',
                data: 'id='+id+'&_token='+token+'&file_name='+fname,
                cache: false,
                success: function(datas){
                 
                    if (datas == 'Success') {
                        $('.edit-image').remove();
                    } else{
                        alert(datas);
                    }
                }
            });
        }
    }
</script>


@endsection