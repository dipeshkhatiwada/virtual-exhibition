@extends('employe_master')
@section('content')
<div class="row cm-row">
  <!-- left pannel of accordian menu and service package ended here -->
  <div class="col-md-12">
    <h3 class="form_heading">{{$datas['name']}} Profile</h3>
    <div class="all10p">
    <div class="common_bg">
      <div class="table-responsive-lg">
      <table class="table table-bordered table-hover employe_profile white_bg">
        <tbody>
          <tr>
            <td><span class="bold">Saluation</span></td>
            <td>{{\App\Saluation::getTitle($datas['user']->saluation)}}</td>
            <td><span class="bold">Name</span></td>
            <td>{{$datas['name']}}</td>
          </tr>
          <tr>
            <td><span class="bold">E-mail</span></td>
            <td>{{$datas['user']->email}}</td>
            <td><span class="bold">Gender</span></td>
            <td>{{$datas['user']->gender}}</td>
          </tr>
          
          <tr>
            <td><span class="bold">Date of Birth</span></td>
            <td>{{$datas['user']->dob}}</td>
            <td><span class="bold">Marital Status</span></td>
            <td>{{$datas['user']->marital_status}}</td>
          </tr>
          
          <tr>
            <td><span class="bold">Nationality</span></td>
            <td>{{$datas['user']->nationality}}</td>
            <td><span class="bold">Permanent Address</span></td>
            <td>{{$datas['address']->permanent}}</td>
          </tr>
          
          <tr>
            <td><span class="bold">Temporary Address</span></td>
            <td>{{$datas['address']->temporary}}</td>
            <td><span class="bold">Home Phone Number</span></td>
            <td>{{$datas['address']->home_phone}}</td>
          </tr>
          
          <tr>
            <td><span class="bold">Mobile Phone</span></td><td>{{$datas['address']->mobile}}</td>
            <td><span class="bold">Fax</span></td><td>{{$datas['address']->fax}}</td>
          </tr>
          
          <tr>
            <td><span class="bold">Website</span></td><td>@if($datas['address']->website != '') <a href="{{$datas['address']->website}}" target="_blank">{{$datas['address']->website}}</a>@endif </td>
            <td><span class="bold">Travel for Job</span></td><td>{{$datas['others']->travel == 1 ? 'Yes' : 'No'}}</td>
          </tr>
          
          <tr>
            <td><span class="bold">Have License</span></td>
            <td>{{$datas['others']->license == 1 ? 'Yes' : 'No'}}</td>
            <td><span class="bold">License of</span></td><td>{{$datas['others']->licenseof}}</td>
          </tr>
          
          <tr>
            <td><span class="bold">Have Vehicle</span></td><td>{{$datas['others']->have_vehical == 1 ? 'Yes' : 'No'}}</td>
            <td><span class="bold">Vehicle</span></td><td>{{$datas['others']->vehical}}</td>
          </tr>
          
          <tr>
            <td><span class="bold">Profile Confidential</span></td><td>{{$datas['others']->confidention == 1 ? 'Yes' : 'No'}}</td>
            <td><span class="bold">Profile Searchable</span></td><td>{{$datas['others']->searchable == 1 ? 'Yes' : 'No'}}</td>
          </tr>
          
          <tr>
            <td><span class="bold">Job Alert</span></td><td>{{$datas['others']->alertable == 1 ? 'Yes' : 'No'}}</td>
            <td><span class="bold">Current Salary</span></td><td>{{$datas['user']->present_salary}}</td>
          </tr>
          
          <tr>
            <td><span class="bold">Expected Salary</span></td><td>{{$datas['user']->expected_salary}}</td>
            <td><span class="bold">Skills</span></td><td>{{$datas['skills']}}</td></tr>
            <tr>
            <td><span class="bold">Professional Heading</span></td><td>{{$datas['user']->professional_heading}}</td>
            <td><span class="bold">Description</span></td><td><?php echo $datas['user']->description;?></td></tr>
        </tbody>
      </table>
    </div>
    </div>
  </div>
  </div>
</div>
@stop