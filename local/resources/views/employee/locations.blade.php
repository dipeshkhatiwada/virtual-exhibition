@extends('employe_master')

@section('content')
  <!-- left pannel of accordian menu and service package ended here -->
    <h3 class="form_heading">{{$datas['name']}} preferred Job Locations, Job Categories and Organization Types</h3>
    <div class="common_bg whitebg btm10p">
      <form class="form-horizontal dash_form" role="form" id="testform" method="POST" action="{{ url('/employee/location/update') }}">
        <input type="hidden" name="id" value="{{$datas['employee']->id}}">
          {!! csrf_field() !!}
          <div class="row cm-row">
            <div class="col-md-4">
              <div class="box box-warning box-solid all15p">
                <div class="box-header with-border">
                  <h3 class="title_two btm10m">Job Locations</h3>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class=" col-me-10 locations">
                    @foreach($datas['joblocation'] as $joblocation)
                    @if(in_array($joblocation->id,$datas['employee_location']))
                    <div class="form-check">
                      <input type="checkbox" checked="checked" class="form-check-input" name="job_location[]" value="{{$joblocation->id}}" >
                      <label class="form-check-label" >{{$joblocation->name}}</label>
                    </div>
                    @else
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="job_location[]" value="{{$joblocation->id}}" >
                      <label class="form-check-label" >{{$joblocation->name}}</label>
                    </div>
                    @endif
                    @endforeach
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <div class="col-md-4">
              <div class="box box-warning box-solid all10p">
                <div class="box-header with-border">
                  <h3 class="title_two btm10m">Job Categories</h3>
                 
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class=" col-me-12 locations">
                    @foreach($datas['jobcategory'] as $jobcategory)
                    @if(in_array($jobcategory->id,$datas['employee_category']))
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" checked="checked" name="job_category[]" value="{{$jobcategory->id}}" >
                      <label class="form-check-label" >{{$jobcategory->name}}</label>
                    </div>
                    @else
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="job_category[]" value="{{$jobcategory->id}}" >
                      <label class="form-check-label" >{{$jobcategory->name}}</label>
                    </div>
                    @endif
                    @endforeach
                  </div>
                </div>
              <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <div class="col-md-4">
              <div class="box box-warning box-solid all10p">
                <div class="box-header with-border">
                  <h3 class="title_two btm10m">Organization Types</h3>
                 
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class=" col-me-12 locations">
                    @foreach($datas['organization_type'] as $organization_type)
                    @if(in_array($organization_type->id,$datas['employee_org']))
                    <div class="form-check">
                      <input type="checkbox" checked="checked" class="form-check-input" name="organization_type[]"  value="{{$organization_type->id}}" >
                      <label class="form-check-label" >{{$organization_type->name}}</label>
                    </div>
                    @else
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="organization_type[]"  value="{{$organization_type->id}}" >
                      <label class="form-check-label" >{{$organization_type->name}}</label>
                    </div>
                    @endif
                    @endforeach
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
          <!-- /.box -->
          </div>
          <div class="col-md-10">
            <div class="form-group row">
              <div class="col-md-10 col-md-offset-4">
                <button type="submit" class="btn bluebg sendbtn">
                  Save <i class="fa fa-paper-plane"></i>
                </button>
              </div>
            </div>
          </div>  
      </form>
    </div><!-- /.box-body -->
  <script type="text/javascript">
    function editCover()
    {
      $('#h_data').fadeOut();
      $('#cl_form').fadeIn();
    }
  </script>
  
  
@stop()