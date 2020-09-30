@extends('employe_master')

@section('content')

  <!-- left pannel of accordian menu and service package ended here -->

  <h3 class="form_heading">{{$datas['name']}} Documents</h3>
  <div class="common_bg dash_forms">
    <div class="table-responsive-lg">
      <table class="table table_form employe_profile">
        <thead>
          <tr>
            <th>Document</th>
            <th>Title</th>
            <th>Action</th>
          </tr>
        </thead>
         
        <tbody>
          <?php $files_row = 1; ?>             
          @foreach($datas['files'] as $files)
          <tr id="document_row_{{$files_row}}">
            <td>
              <div class="uploadfile">
                <a href="{{$files['url']}}" target="_blank"><img src="{{asset($files['thumb'])}}"> {{$files['f_name']}}</a>
              </div>
            </td>
            <td>
              <span class="greenclr">{{$files['title']}}</span>
            </td>
            <td>
              <button type="button" onclick="removefiles({{$files['id']}}, '{{$files["type"]}}',{{$files_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
            </td>
          </tr>
       
          @php($files_row++)
          @endforeach
           </tbody>
      </table>
    </div>
    <div class="careerfy-table-layer careerfy-managejobs-today">
      @if($datas['employee']->resume == '') <button type="button" id="upload_resume" data-toggle="tooltip" title="Upload Files" class="btn bluebg sendbtn tp10m"><i class="fa fa-upload"></i> Upload Resume</button> @endif<div class=""><button type="button" id="upload_files" data-toggle="tooltip" title="Upload Files" class="btn sendbtn bluebg tb10m"><i class="fa fa-upload"></i> Upload files</button></div>
    </div>     
  </div>
  <script type="text/javascript">
    function removefiles(id,type,row)
    {
      if(confirm('Are you sure, Do You Want To Delete This files?')){
      var token = $('input[name=\'_token\']').val();
      if (type == 'Resume') {
        var url = '{{url("/employee/resume/delete")}}';
      } else {
        var url = '{{url("/employee/documents/delete")}}';
      }
          $.ajax({
            type: 'POST',
            url: url,
            data: 'id='+id+'&_token='+token,
            cache: false,
            success: function(Success){
                $('#document_row_'+row).remove();
               
            }
        });
        }
    }
</script>

<script type="text/javascript">
      $('#upload_files').on('click', function() {
        $('#upload_form').remove();
        var url = "{{url('/employee/uploadfile')}}";
        $('body').prepend('<form enctype="multipart/form-data" action="'+url+'" id="upload_form" method="POST" style="display: none;"><input type="file" id="file" name="documents[]" value="" multiple="multiple" /><input type="text" name="_token" value="{{ csrf_token() }}" /></form>');

        $('#upload_form #file').trigger('click');
        if (typeof timer != 'undefined') {
              clearInterval(timer);
          }

          timer = setInterval(function() {
            if ($('#upload_form #file').val() != '') {
              clearInterval(timer);
                $('#upload_form').submit();
                }
          }, 500);

      });
    </script>

    <script type="text/javascript">
      $('#upload_resume').on('click', function() {
        $('#upload_form').remove();
        var url = "{{url('/employee/uploadresume')}}";
        $('body').prepend('<form enctype="multipart/form-data" action="'+url+'" id="upload_form" method="POST" style="display: none;"><input type="file" id="file" name="resume" value=""/><input type="text" name="_token" value="{{ csrf_token() }}" /></form>');

        $('#upload_form #file').trigger('click');
        if (typeof timer != 'undefined') {
              clearInterval(timer);
          }

          timer = setInterval(function() {
            if ($('#upload_form #file').val() != '') {
              clearInterval(timer);
                $('#upload_form').submit();
                }
          }, 500);

      });
    </script> 
  
@stop()

