@extends('employe_master')

@section('content')
  <!-- left pannel of accordian menu and service package ended here -->
    <h3 class="form_heading">Recommended Project(s)</h3>
    <div class="common_bg all10p">
      <div class="careerfy-managejobs-list-wrap">
        <div class="careerfy-managejobs-list">
          <!-- Manage Jobs Header -->
          <div class="careerfy-table-layer careerfy-managejobs-thead">
            <div class="careerfy-table-row">
              
              <div class="careerfy-table-cell">Project Title</div>
              <div class="careerfy-table-cell">Published By</div>
              <div class="careerfy-table-cell">Skills</div>
              <div class="careerfy-table-cell">Description</div>
              <div class="careerfy-table-cell">Published On</div>
              
            </div>
          </div>
          <div class="careerfy-table-layer careerfy-managejobs-tbody">
            @foreach($data['projects'] as $project)
            
            <div class="careerfy-table-row">
              
              <div class="careerfy-table-cell">
                <a href="{{$project['href']}}" target="_blank" class="greenclr">{{$project['title']}}</a>
              </div>
              <div class="careerfy-table-cell">
                {{$project['publish_by']}}
              </div>
              <div class="careerfy-table-cell">
                {{$project['skills']}}
              </div>
              <div class="careerfy-table-cell">{{$project['description']}}</div>
              
              <div class="careerfy-table-cell "><span class="applied_date"> {{$project['publish_date']}}</span></div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
</div>
  
  
@stop()