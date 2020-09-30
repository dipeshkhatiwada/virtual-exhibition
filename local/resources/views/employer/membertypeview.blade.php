@extends('employer_master')
@section('heading')
{{$data->name}} Detail 
           
@stop
@section('breadcrubm')
 <li><a href="{{ url('/employer') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            
            <li class="active">{{$data->name}} Detail</li>
@stop
@section('content')

          <div class="card">
            <div class="form_heading">{{$data->name}} 
              <span><img src="{{asset('/image/'.$data->icon)}}"></span>
            </div>
          </div>
          <div class="all10p">             
                <div class="title_two btm10p">Features</div>
                <div class="card">
                  <div class="detail">
                    <span class="bold italic">Display Type:</span> {{$data->display_type}}
                  </div>
                
                  <div class="detail">
                    <span class="bold italic"> Position: </span>{{$data->position}}
                  </div>
              
                                            
              
                   
                    <div class="detail">
                        <span class="bold italic">Priority:</span> {{ $data->priority}}
                   </div>
                    <div class="detail">
                        <span class="bold italic">Placement:</span> {{ $data->placement}}
                   </div>

                    <div class="detail">
                        <span class="bold italic">Control Panel:</span> {{ $data->control_panel == 1 ? 'Yes' : 'No'}}
                   </div>
                    <div class="detail">
                        <span class="bold italic">Rating Features:</span> {{ $data->rating_feature == 1 ? 'Yes' : 'No'}}
                   </div>

                    <div class="detail">
                        <span class="bold italic">Images:</span> {{ $data->images == 1 ? 'Yes' : 'No'}}
                   </div>

                    <div class="detail">
                        <span class="bold italic">Communication with Job Seeker:</span> {{ $data->communication == 1 ? 'Yes' : 'No'}}
                   </div>

                    <div class="detail">
                        <span class="bold italic">Privacy Setting:</span> {{ $data->privacy_setting == 1 ? 'Yes' : 'No'}}
                   </div>

                    <div class="detail">
                        <span class="bold italic">Coloured Background:</span> {{ $data->background == 1 ? 'Yes' : 'No'}}
                   </div>
                    <div class="detail">
                        <span class="bold italic">Customized Page:</span> {{ $data->customized_page }}
                   </div>

                   

                   <div class="detail">
                        <span class="bold italic">Job alert:</span> {{ $data->job_alert == 1 ? 'Yes' : 'No'}}
                   </div>

                   <div class="detail">
                        <span class="bold italic">Listing recommended Job/Similar Job:</span> {{ $data->listing_recomended == 1 ? 'Yes' : 'No'}}
                   </div>

                   <div class="detail">
                        <span class="bold italic">Listing in search:</span> {{ $data->listing_search == 1 ? 'Yes' : 'No'}}
                   </div>
                   <div class="detail">
                        <span class="bold italic">SMS alert:</span> {{ $data->sms_alert == 1 ? 'Yes' : 'No'}}
                   </div>
                    <div class="detail">
                        <span class="bold italic">Email auto responder:</span> {{ $data->job_alert == 1 ? 'Yes' : 'No'}}
                   </div>

                    <div class="detail">
                        <span class="bold italic">Application Collecting:</span> {{ $data->app_collecting == 1 ? 'Yes' : 'No'}}
                   </div>

                    <div class="detail">
                        <span class="bold italic">Application Screening:</span> {{ $data->app_screeing == 1 ? 'Yes' : 'No'}}
                   </div>

                    <div class="detail">
                        <span class="bold italic">Application Shorting:</span> {{ $data->app_shorting == 1 ? 'Yes' : 'No'}}
                   </div>
                    <div class="detail">
                        <span class="bold italic">Access on database:</span> {{ $data->data_access == 1 ? 'Yes' : 'No'}}
                   </div>

                    <div class="detail">
                        <span class="bold italic">Web Template:</span> {{ $data->web_template }}
                   </div>
                    <div class="detail">
                        <span class="bold italic">Expert consultation:</span> {{ $data->expert_consultation}}
                   </div>
                    <div class="detail">
                        <span class="bold italic">Number of Employees:</span> {{ $data->no_of_employee}}
                   </div>

                   <div class="detail">
                        <span class="bold italic">Number of Jobs:</span> {{ $data->no_of_job}}
                   </div>
                   <div class="detail">
                        <span class="bold italic">Minimum Contract Period:</span> {{ $data->contact_period}}
                   </div>
                   <div class="detail">
                        <span class="bold italic">Service Charge:</span> {{ $data->service_charge}}
                   </div>

                   <div class="detail">
                        <span class="bold italic">Remarks:</span> {{ $data->remarks}}
                   </div>
                    
                        
                   </div>
                </div>                            
                                        
@endsection


    
