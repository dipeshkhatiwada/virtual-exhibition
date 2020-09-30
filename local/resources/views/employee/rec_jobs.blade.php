@extends('employe_master')

@section('content')
  <!-- left pannel of accordian menu and service package ended here -->
    <h3 class="form_heading">Recommended Job(s)</h3>
    <div class="common_bg all10p">
      <div class="careerfy-managejobs-list-wrap">
        <div class="careerfy-managejobs-list">
          <!-- Manage Jobs Header -->
          <div class="careerfy-table-layer careerfy-managejobs-thead">
            <div class="careerfy-table-row">
              <div class="careerfy-table-cell">Job Title</div>
              <div class="careerfy-table-cell">Availability</div>
              <div class="careerfy-table-cell">Positions</div>
              <div class="careerfy-table-cell">Vacancy Code</div>
              <div class="careerfy-table-cell">Salary</div>
              <div class="careerfy-table-cell">Deadline</div>
            </div>
          </div>
          <div class="careerfy-table-layer careerfy-managejobs-tbody">
            @foreach($jobs as $recomended)
            @php($rempurl = \App\Employers::getUrl($recomended->employers_id))
            <div class="careerfy-table-row">
              
              <div class="careerfy-table-cell">
                <a href="{{url('/jobs/'.$rempurl.'/'.$recomended->seo_url)}}" target="_blank" class="greenclr">{{$recomended->title}}</a>
              </div>
              <div class="careerfy-table-cell">
                {{$recomended->job_availability}}
              </div>
              <div class="careerfy-table-cell">
                {{$recomended->position}}
              </div>
              <div class="careerfy-table-cell">{{$recomended->vacancy_code}}</div>
              <div class="careerfy-table-cell">{{\App\Currency::getSymbol($recomended->salary_unit)}} {{$recomended->minimum_salary}}</div>
              <div class="careerfy-table-cell "><span class="applied_date"> {{$recomended->deadline}}</span></div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
</div>
@stop()