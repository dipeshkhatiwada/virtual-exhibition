@extends('employer_master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <h3 class="form_heading">Search Resume  
            @if(!isset($datas['check']->id))
            <a href="{{url('/employer/buy_resume_package')}}" type="button" class="btn upgradebtn right">
            <i class="fa fa-plus-circle"></i> Buy Package
          </a>
          @else
          <span class="right redclr">You have remaining {{$datas['check']->remaining}} resume to download</span>
          @endif
      </h3>

<div id="advance_search_box" class="col-md-12" aria-labelledby="headingOne" data-parent="#accordionExample">
  
  <div class="common_bg">
    <div class="form-group row ">
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-4">
            <label class="">Education Level</label>
            <select class="form-control" id="filter_education">
              <option value="">Select Level</option>
              @foreach($datas['education_levels'] as $level)
              @if($level->id == $datas['filter_education'])
              <option selected="selected" value="{{$level->id}}">{{$level->name}}</option>
              @else
              <option value="{{$level->id}}">{{$level->name}}</option>
              @endif
              @endforeach
            </select>
            
            
          </div>
          <div class="col-md-4">
            <label class="">Faculty</label>
             <select class="form-control" id="filter_faculty">
              <option value="">Select Faculty</option>
              @if(count($datas['faculty']) > 0)
              @foreach($datas['faculty'] as $faculty)
              @if($faculty->id == $datas['filter_faculty'])
              <option selected="selected" value="{{$faculty->id}}">{{$faculty->name}}</option>
              @else
              <option value="{{$faculty->id}}">{{$faculty->name}}</option>
              @endif
              @endforeach
              @endif
            </select>
          </div>
          <div class="col-md-4">
            <label class="">Greater than Percentage</label>
            <input type="text" id="filter_percentage"  name="filter_percentage" class="form-control" value="{{ $datas['filter_percentage'] }}" placeholder="50">
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-6">
            <label class="">Greater than CGPA Out of 4</label>
            <input type="text" id="filter_cgpa4"  name="filter_cgpa4" class="form-control" value="{{ $datas['filter_cgpa4'] }}" placeholder="3">
          </div>
          <div class="col-md-6">
            <label class="">Greater than CGPA Out of 10</label>
            <input type="text" id="filter_cgpa10"  name="filter_cgpa10" class="form-control" value="{{ $datas['filter_cgpa10'] }}" placeholder="8">
          </div>
        </div>
      </div>
    </div>
    <div class="form-group row ">
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-4">
            <label class="">Minimum Age</label>
            <input type="text" id="filter_minimum_age"  name="filter_minimum_age" class="form-control" value="{{ $datas['filter_minimum_age'] }}" placeholder="18">
            
          </div>
          <div class="col-md-4">
            <label class="">Maximum Age</label>
            <input type="text" id="filter_maximum_age"  name="filter_maximum_age" class="form-control" value="{{ $datas['filter_maximum_age'] }}" placeholder="35">
          </div>
          <div class="col-md-4">
            <label class="">Greater than Experience(Years)</label>
            <input type="text" id="filter_experience"  name="filter_experience" class="form-control" value="{{ $datas['filter_experience'] }}" placeholder="5">
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-6">
            <label class="">Travel</label>
            <select class="form-control" id="filter_travel">
              <option value="">Select Option</option>
              @foreach($datas['yesno'] as $yn)
              @if($yn['value'] == $datas['filter_travel'])
              <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}}</option>
              @else
              <option value="{{$yn['value']}}">{{$yn['title']}}</option>
              @endif
              @endforeach
            </select>
            
          </div>
          <div class="col-md-6">
            <label class="">Willing to relocate</label>
            <select class="form-control" id="filter_relocate">
             <option value="">Select Option</option>
              @foreach($datas['yesno'] as $yn)
              @if($yn['value'] == $datas['filter_relocate'])
              <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}}</option>
              @else
              <option value="{{$yn['value']}}">{{$yn['title']}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group row ">
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-4">
            <label class="">Have Driving License</label>
            <select class="form-control" id="filter_license">
               <option value="">Select Option</option>
              @foreach($datas['yesno'] as $yn)
              @if($yn['value'] == $datas['filter_travel'])
              <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}}</option>
              @else
              <option value="{{$yn['value']}}">{{$yn['title']}}</option>
              @endif
              @endforeach
            </select>
            
          </div>
          <div class="col-md-4">
            <label class="">Have Vehicle</label>
            <select class="form-control" id="filter_vehicle">
               <option value="">Select Option</option>
              @foreach($datas['yesno'] as $yn)
              @if($yn['value'] == $datas['filter_travel'])
              <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}}</option>
              @else
              <option value="{{$yn['value']}}">{{$yn['title']}}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label class="">Language</label>
            <select class="form-control" id="filter_language">
               <option value="">Select Language</option>
              @foreach($datas['language'] as $language)
              @if($language->language == $datas['filter_language'])
              <option selected="selected" value="{{$language->language}}">{{$language->language}}</option>
              @else
              <option value="{{$language->language}}">{{$language->language}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-6">
            <label class="">Gender</label>
            <select class="form-control" id="filter_gender">
               <option value="">Select Gender</option>
              @foreach($datas['gender'] as $gender)
              @if($gender['value'] == $datas['filter_gender'])
              <option selected="selected" value="{{$gender['value']}}">{{$gender['title']}}</option>
              @else
              <option value="{{$gender['value']}}">{{$gender['title']}}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label class="">Marital Status</label>
            <select class="form-control" id="filter_marital_status">
               <option value="">Select Marital Status</option>
              @foreach($datas['marital_status'] as $marital_status)
              @if($marital_status['value'] == $datas['filter_marital_status'])
              <option selected="selected" value="{{$marital_status['value']}}">{{$marital_status['title']}}</option>
              @else
              <option value="{{$marital_status['value']}}">{{$marital_status['title']}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group row ">
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-4">
            <label class="">Minimum Expected Salary</label>
            <input type="text" id="filter_minimum_salary"  name="filter_minimum_salary" class="form-control" value="{{ $datas['filter_minimum_salary'] }}" placeholder="20000">
            
          </div>
          <div class="col-md-4">
            <label class="">Maximum Expected Salary</label>
            <input type="text" id="filter_maximum_salary"  name="filter_maximum_salary" class="form-control" value="{{ $datas['filter_maximum_salary'] }}" placeholder="50000">
          </div>
          <div class="col-md-4">
            <label class="">Nationality</label>
             <select class="form-control" id="filter_nationality">
               <option value="">Select Nationality</option>
              @foreach($datas['nationality'] as $nationality)
              @if($nationality->nationality == $datas['filter_nationality'])
              <option selected="selected" value="{{$nationality->nationality}}">{{$nationality->nationality}}</option>
              @else
              <option value="{{$nationality->nationality}}">{{$nationality->nationality}}</option>
              @endif
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-6">
            <label class="">Preferred Location</label>
            <select class="form-control" id="filter_location">
               <option value="">Select Location</option>
              @foreach($datas['locations'] as $location)
              @if($location->id == $datas['filter_location'])
              <option selected="selected" value="{{$location->id}}">{{$location->name}}</option>
              @else
              <option value="{{$location->id}}">{{$location->name}}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label></label>
            <a href="javascript:void(0);" onclick="filterAdvance()" class="btn lightgreen_gradient"><i class="fa fa-fw fa-search"></i> Filter</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>
          
          <div class="panel-heading all10p">
     
      
      <div class="careerfy-typo-wrap">
          <div class="careerfy-employer-dasboard btm10m">
              <div class="careerfy-employer-box-section">
                  @if(count($datas['employees']) > 0)
                  <!-- Manage Jobs -->
                  
                  <div class="careerfy-managejobs-list-wrap">
                      <div class="careerfy-managejobs-list">
                          <!-- Manage Jobs Header -->
                          <div class="careerfy-table-layer careerfy-managejobs-thead">
                              <div class="careerfy-table-row">
                                <div class="careerfy-table-cell" style="max-width: 2% !important; min-width: 2% !important;">S.N. </div>
                                  <div class="careerfy-table-cell">Name</div>
                                  
                                  <div class="careerfy-table-cell">Action</div>
                              </div>
                          </div>
                          
                          @php($i=1)
                          @foreach($datas['employees'] as $row)
                          <!-- Manage Jobs Body -->
                          <div class="careerfy-table-layer careerfy-managejobs-tbody">
                              <div class="careerfy-table-row">
                                 <div class="careerfy-table-cell" style="max-width: 2% !important; min-width: 2% !important;">{{$i++}} </div>
                                  <div class="careerfy-table-cell">
                                     {{\App\Employees::getName($row->id)}}
                                  </div>
                                 
                                  
                                  <div class="careerfy-table-cell">
                                      <div class="careerfy-managejobs-links">
                                          <a  href="javascript:void(0)" class="btn whitegradient blueclr" data-toggle="tooltip" data-placement="top" title="View" onclick="viewEmployee({{$row->id}})"><i class="far fa-eye"></i> View</a>
                                          <a href="javascript:void(0)" class="btn whitegradient greenclr left redclr" data-toggle="tooltip" data-placement="top"title="Download" onclick="downloadCV({{$row->id}})"><i class="fa fa-download"></i> Download</a>
                                          
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- Manage Jobs Body -->
                          @endforeach

                        
                      </div>
                  </div>
              
                  <!-- Pagination -->
                  
                       <?php echo $datas['employees']->render();?>
                 
                  @else
                  <div style="clear: both;"></div>
                  <div class="alert alert-info text-center">
                      <span class="icon-circle-warning mr-2"></span>
                       @if(!isset($datas['check']->id))
            <a href="{{url('/employer/buy_resume_package')}}" type="button" class="btn upgradebtn">
            <i class="fa fa-plus-circle"></i> Buy Package
          </a>
          @else
            No any Resume found at the moment.
          @endif
                    
                      
                  </div>
                  @endif
              </div>
          </div>
      </div>
    </div>
        
    </div>
</div>
<form class="form-horizontal" role="form" id="testform" method="POST" action="">
                {!! csrf_field() !!}
                  
                    <input type="hidden" name="employee_id" id="employee_id" value="">


</form>
<script type="text/javascript">
 

function downloadCV(id) {
   if(confirm('Are you sure you want to download CV?')){
      $('#testform').attr('action', '{{ url("/employer/searchresume/download") }}');
      $('#employee_id').val(id);
      $('#testform').submit();
      
      }
}

function viewEmployee(id) {
     $('#testform').attr('action', '{{ url("/employer/searchresume/view") }}');
    $('#employee_id').val(id);
      $('#testform').submit();
}



</script>
<script type="text/javascript">
 

 

  function filterAdvance(){
   var filter_education = $('#filter_education').val();
  
   var filter_faculty = $('#filter_faculty').val();
   var filter_percentage = $('#filter_percentage').val();
   var filter_cgpa4 = $('#filter_cgpa4').val();
   var filter_cgpa10 = $('#filter_cgpa10').val();
   var filter_minimum_age = $('#filter_minimum_age').val();
   var filter_maximum_age = $('#filter_maximum_age').val();
   var filter_experience = $('#filter_experience').val();
   var filter_travel = $('#filter_travel').val();
   var filter_relocate = $('#filter_relocate').val();
   var filter_license = $('#filter_license').val();
   var filter_vehicle = $('#filter_vehicle').val();
   var filter_language = $('#filter_language').val();
   var filter_gender = $('#filter_gender').val();
   var filter_marital_status = $('#filter_marital_status').val();
   var filter_minimum_salary = $('#filter_minimum_salary').val();
   var filter_maximum_salary = $('#filter_maximum_salary').val();
   var filter_nationality = $('#filter_nationality').val();
   var filter_location = $('#filter_location').val();
  
    var url= "{{ url('/employer/searchresume?') }}";
   if (filter_education != '') {
      url += '&filter_education='+filter_education;
   }
   
   if (filter_faculty != '') {
      url += '&filter_faculty='+filter_faculty;
   }
   if (filter_percentage != '') {
      url += '&filter_percentage='+filter_percentage;
   }

   if (filter_cgpa4 != '') {
      url += '&filter_cgpa4='+filter_cgpa4;
   }
   if (filter_cgpa10 != '') {
      url += '&filter_cgpa10='+filter_cgpa10;
   }
   if (filter_minimum_age != '') {
      url += '&filter_minimum_age='+filter_minimum_age;
   }
   if (filter_maximum_age != '') {
      url += '&filter_maximum_age='+filter_maximum_age;
   }
   if (filter_experience != '') {
      url += '&filter_experience='+filter_experience;
   }
   if (filter_travel != '') {
      url += '&filter_travel='+filter_travel;
   }
   if (filter_relocate != '') {
      url += '&filter_relocate='+filter_relocate;
   }
   if (filter_license != '') {
      url += '&filter_license='+filter_license;
   }
   if (filter_vehicle != '') {
      url += '&filter_vehicle='+filter_vehicle;
   }
   if (filter_language != '') {
      url += '&filter_language='+filter_language;
   }
   if (filter_gender != '') {
      url += '&filter_gender='+filter_gender;
   }
   if (filter_marital_status != '') {
      url += '&filter_marital_status='+filter_marital_status;
   }
   if (filter_minimum_salary != '') {
      url += '&filter_minimum_salary='+filter_minimum_salary;
   }
   if (filter_maximum_salary != '') {
      url += '&filter_maximum_salary='+filter_maximum_salary;
   }
   if (filter_nationality != '') {
      url += '&filter_nationality='+filter_nationality;
   }
   if (filter_location != '') {
      url += '&filter_location='+filter_location;
   }
  
   location = url;

  }
 </script>









<script type="text/javascript">
 

  $(document).on('change', '#filter_education', function(){
       
        var data = $(this).val();
        var token = $('input[name=\'_token\']').val();
        if (data != '0') {
            $.ajax({
        type: 'POST',
        url: '{{url("/getfaculty")}}',
        data: 'id='+data+'&_token='+token,
        cache: false,
        success: function(html){
            $('#filter_faculty').html(html);
           
        }
    });
        } else{
            html = '<option value="0">Select Faculty</option>';
            $('#filter_faculty').html(html);
        }
    });
 </script>
@endsection