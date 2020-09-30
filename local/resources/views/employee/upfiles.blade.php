@extends('employe_master')

@section('content')

  <!-- left pannel of accordian menu and service package ended here -->

    <h3 class="form_heading">{{$datas['name']}} Update Document Title</h3>
    <div class="common_bg">
      <div class="careerfy-managejobs-list-wrap">
        <div class="careerfy-managejobs-list">
          <!-- Manage Jobs Header -->
          <div class="careerfy-table-layer careerfy-managejobs-thead">
            <div class="careerfy-table-row">
              
              <div class="careerfy-table-cell">Title</div>
              <div class="careerfy-table-cell">Document</div>
              <div class="careerfy-table-cell">Action</div>
             
            </div>
          </div>
          <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/updateTitle') }}">
                <input type="hidden" name="id" value="{{$datas['employee']->id}}">
               
                        {!! csrf_field() !!}
          <div class="careerfy-table-layer careerfy-managejobs-tbody">
            @foreach($datas['files'] as $files)
            <div class="careerfy-table-row">
              <div class="careerfy-table-cell">
                <input type="text" class="form-control" name="documents[{{$files['id']}}][title]" value="{{$files['title']}}">
              </div>
              <div class="careerfy-table-cell">
                <img src="{{asset($files['thumb'])}}"> {{$files['f_name']}}
              </div>
              <div class="careerfy-table-cell">
                <button type="button" onclick="removeFile({{$files['id']}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
              </div>
            </div>
            @endforeach
            <div class="form-group">
                <button type="submit" class="btn bluebg sendbtn tp10m">
                    Save <i class="fa fa-paper-plane"></i>
                </button>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>
   <script type="text/javascript">
    function removeFile(id)
    {
      if(confirm('Are you sure, Do You Want To Delete This Education?')){
      var token = $('input[name=\'_token\']').val();
          $.ajax({
            type: 'POST',
            url: '{{url("/employee/deletefile")}}',
            data: 'id='+id+'&_token='+token,
            cache: false,
            success: function(Success){
                $('#row-'+id).remove();
               
            }
        });
        }
    }    
</script>
  
@stop()


