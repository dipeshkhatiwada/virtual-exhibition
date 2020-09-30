<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;" onload="window.print()">
  <div style="position: fixed; top: 45%; width: 100%; text-align: center; opacity: .1; transform: rotate(30deg); transform-origin: 50% 50%; z-index: 9999; font-size: 100px;">ROLLING NEXUS </div>
<div style="width: 95%; margin: auto; padding: 10px;"">
   <div style="float: left; font-family: arial; font-size: 12px; width: 49%;">
    <p style="font-weight: 700; font-size: 21px; margin-top: 2px; margin-bottom: 2px;">{{\App\Employees::getFullname($datas['employee']->firstname,$datas['employee']->middlename,$datas['employee']->lastname)}}</p>
    <p style="margin-top: 2px; margin-bottom: 20px;">{{$datas['employee']->email}}</p>
   </div>
   @if($datas['image'] != '')
<div style="width:49%; float: right; margin-top: 2px; margin-bottom: 5px;"><img src="{{$datas['image']}}" style="max-height: 100px; float: right; max-width: 100%;"></div>
@endif
<p style="clear: both;"></p>
  <table style="border-collapse: collapse; border: 1px solid #036cd9; width: 100%; margin-bottom: 20px; position: relative;">
     
    <thead>
      <tr style="background: #036cd9">
      <td colspan="2" style="font-size: 12px; vertical-align: middle; width: 100%; border-right: 1px solid #036cd9; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px; color: #ffffff;">Personal Information</td>
        
        
        
      </tr>
      
    </thead>
   
    <tbody>
                         <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Application ID</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->id}}</td>
                          
                        </tr>
                        
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Full Name</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{\App\Employees::getFullname($datas['employee']->firstname,$datas['employee']->middlename,$datas['employee']->lastname)}}</td>
                          
                        </tr>
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">E-mail</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->email}}</td>
                          
                        </tr>
                        @if($datas['employee']->gender != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Gender</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->gender}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['employee']->dob != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Date of Birth</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->dob}}</td>
                          
                        </tr>
                        @endif
                         @if($datas['employee']->age != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Age</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->age}}</td>
                          
                        </tr>
                        @endif
                         @if($datas['employee']->total_experience != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Total Experience</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->total_experience}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['employee']->marital_status != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Marital Status</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->marital_status}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['employee']->nationality != '')
                         <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Nationality</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->nationality}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['employee']->vehicle != '')
                         <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Vehicle</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->vehicle}}</td>
                          
                        </tr>
                        @endif
                         @if($datas['employee']->license_of != '')
                         <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">License Of</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->license_of}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['employee']->permanent_address != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Permanent Address</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->permanent_address}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['employee']->temporary_address != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Temporary Address</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->temporary_address}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['employee']->home_phone != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Home Phone</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->home_phone}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['employee']->mobile != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Mobile Phone</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->mobile}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['employee']->fax != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Fax Number</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->fax}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['employee']->website != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Website</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['employee']->website}}</td>
                          
                        </tr>
                        @endif
                        
                        @if($datas['employee']->resume != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Resume</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;"><a href="{{asset('image/'.$datas['employee']->resume)}}" style="background: #008d4c;padding: 10px;" target="_blank" download>Download</a></td>
                          
                        </tr>
                        @endif
                        @if($datas['employee']->cover_letter != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Cover Letter</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;"><a href="{{asset('image/'.$datas['employee']->cover_letter)}}" style="background: #008d4c;padding: 10px;" target="_blank" download>Download</a></td>
                          
                        </tr>
                        @endif
                       
                      
                      
                        
                        
                         
    </tbody>
   
  </table>
@if(count($datas['education']) > 0)
<p style="font-weight: 700; font-size: 15px; margin-top: 20px; margin-bottom: 20px; text-decoration: underline; ">Education Qualification</p>
<table style="border-collapse: collapse; border: 1px solid #036cd9; width: 100%; margin-bottom: 20px; position: relative;">
                             <thead>
                              <tr>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Country</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Education Level</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Faculty</th>
                               
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Institution</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Board</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Percent/Grade</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px; border-right: 1px solid #036cd9;">Year</th>
                                </tr>
                            </thead>
                            <tbody>
                          
                              @foreach($datas['education'] as $education)
                                <tr>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$education->country}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{\App\Faculty::getLevelTitle($education->level_id)}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{\App\Faculty::getTitle($education->faculty_id)}}</td>
                                  
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$education->institution}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$education->board}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$education->percentage}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$education->year}}</td>
                                </tr>
                              @endforeach
                         
                          </tbody>
                            </table>
@endif

@if(count($datas['training']) > 0)
<p style="font-weight: 700; font-size: 15px; margin-top: 20px; margin-bottom: 20px; text-decoration: underline; ">Trainings</p>
<table style="border-collapse: collapse; border: 1px solid #036cd9; width: 100%; margin-bottom: 20px; position: relative;">
                             <thead>
                               <tr>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Title</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Details</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Institution</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Duration</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px; border-right: 1px solid #036cd9;">Year</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                          
                              @foreach($datas['training'] as $training)
                                <tr>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$training->title}}</td>
                                   
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$training->details}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$training->institution}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$training->duration}}</td>
                                    
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$training->year}}</td>
                                    
                                </tr>
                              @endforeach
                         
                          </tbody>
                            </table>
@endif

@if(count($datas['experience']) > 0)
<p style="font-weight: 700; font-size: 15px; margin-top: 20px; margin-bottom: 20px; text-decoration: underline; ">Experiences</p>
<table style="border-collapse: collapse; border: 1px solid #036cd9; width: 100%; margin-bottom: 20px; position: relative;">
                             <thead>
                              <tr>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Organization</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Type of Employment</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Organization Type</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Designation</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Job Level</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">From</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">To</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Working Status</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px; border-right: 1px solid #036cd9;">Country</th>
                               
                                </tr>
                            </thead>
                            <tbody>
                          
                              @foreach($datas['experience'] as $experience)
                                <tr>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience->organization}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience->typeofemployment}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{\App\OrganizationType::getOrgTypeTitle($experience->org_type_id)}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience->designation}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience->level}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience->from}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience->to}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience->currently_working == 1 ? 'Currently Working' : 'Not Working'}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience->country}}</td>
                                   
                                </tr>
                                <tr> <td colspan="9" style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{!! $experience->experience !!}</td></tr>
                              @endforeach
                         
                          </tbody>
                            </table>
@endif

@if(count($datas['language']) > 0)
<p style="font-weight: 700; font-size: 15px; margin-top: 20px; margin-bottom: 20px; text-decoration: underline; ">Languages</p>
<table style="border-collapse: collapse; border: 1px solid #036cd9; width: 100%; margin-bottom: 20px; position: relative;">
                             <thead>
                              <tr>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Language</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Understand</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Speak</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Read</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Write</th>
                               
                                
                                </tr>
                            </thead>
                            <tbody>
                          
                              @foreach($datas['language'] as $language)
                                <tr>
                                  
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$language->language}}</td>
                                   
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$language->understand}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$language->speak}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$language->reading}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$language->writing}}</td>
                                   
                                    
                                </tr>
                              @endforeach
                         
                          </tbody>
                            </table>
@endif

 @if(count($datas['reference']) > 0)
<p style="font-weight: 700; font-size: 15px; margin-top: 20px; margin-bottom: 20px; text-decoration: underline; ">References</p>
<table style="border-collapse: collapse; border: 1px solid #036cd9; width: 100%; margin-bottom: 20px; position: relative;">
                             <thead>
                              <tr>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Name</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Designation</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Address</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Office Phone</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Mobile Phone</th>
                               <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">E-mail</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px; border-right: 1px solid #036cd9;">Company</th>
                                </tr>
                            </thead>
                            <tbody>
                          
                              @foreach($datas['reference'] as $reference)
                                <tr>
                                  
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference->name}}</td>
                                   
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference->designation}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference->address}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference->office_phone}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference->mobile}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference->email}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference->company}}</td>
                                </tr>
                              @endforeach
                         
                          </tbody>
                            </table>
@endif

</div>
</body>

</html>


