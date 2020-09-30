<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;" onload="window.print()">
<div style="width: 95%; margin: auto; padding: 10px;"">
   
<p style="clear: both;"></p>
  <table style="border-collapse: collapse; border: 1px solid #036cd9; width: 100%; margin-bottom: 20px; position: relative;">
     
    <thead>
      <tr style="background: #036cd9">
      <td colspan="2" style="font-size: 12px; vertical-align: middle; width: 100%; border-right: 1px solid #036cd9; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Personal Information</td>
        
        
        
      </tr>
      
    </thead>
   
    <tbody>
     
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Full Name</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{\App\Employees::getFullname($datas['firstname'],$datas['middlename'],$datas['lastname'])}}</td>
                          
                        </tr>
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">E-mail</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['email']}}</td>
                          
                        </tr>
                        @if($datas['gender'] != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Gender</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['gender']}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['dob'] != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Date of Birth</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['dob']}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['marital_status'] != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Marital Status</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['marital_status']}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['nationality'] != '')
                         <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Nationality</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['nationality']}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['vehicle'] != '')
                         <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Vehicle</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['vehicle']}}</td>
                          
                        </tr>
                        @endif
                         @if($datas['license_of'] != '')
                         <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">License Of</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['license_of']}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['permanent_address'] != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Permanent Address</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['permanent_address']}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['temporary_address'] != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Temporary Address</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['temporary_address']}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['home_phone'] != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Home Phone</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['home_phone']}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['mobile'] != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Mobile Phone</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['mobile']}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['fax'] != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Fax Number</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['fax']}}</td>
                          
                        </tr>
                        @endif
                        @if($datas['website'] != '')
                        <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">Website</td>
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$datas['website']}}</td>
                          
                        </tr>
                        @endif
                        
                        @if(count($datas['my_datas']) > 0)
                        @foreach($datas['my_datas'] as $key => $formdata)
                          <tr>
                          <td style="font-size: 12px; font-weight: 700; border-right: 1px solid #036cd9; text-align: left; padding: 7px; width: 25%;">{{$datas['optitle'][$key]}}</td>
                         
                          <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px;">{{$formdata}}</td>
                         
                          
                        </tr>
                        @endforeach
                        @endif
                      
                      
                        
                        
                         
    </tbody>
   
  </table>
@if(count($datas['educations']) > 0)
<p style="font-weight: 700; font-size: 15px; margin-top: 20px; margin-bottom: 20px; text-decoration: underline; ">Education Qualification</p>
<table style="border-collapse: collapse; border: 1px solid #036cd9; width: 100%; margin-bottom: 20px; position: relative;">
                             <thead>
                              <tr>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Country</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Education Level</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Faculty</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Specialization</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Institution</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Board</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px;">Percent/Grade</th>
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px; border-right: 1px solid #036cd9;">Year</th>
                                </tr>
                            </thead>
                            <tbody>
                          
                              @foreach($datas['educations'] as $education)
                                <tr>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$education['country']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{\App\faculty::getLevelTitle($education['level_id'])}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{\App\Faculty::getTitle($education['faculty'])}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$education['specialization']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$education['institution']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$education['board']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$education['percent']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$education['year']}}</td>
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
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$training['title']}}</td>
                                   
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$training['details']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$training['institution']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$training['duration']}}</td>
                                    
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$training['year']}}</td>
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
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience['organization']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience['typeofemployment']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{\App\OrganizationType::getOrgTypeTitle($experience['org_type_id'])}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience['designation']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience['level']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience['from']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience['to']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience['currently_working'] == 1 ? 'Currently Working' : 'Not Working'}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$experience['country']}}</td>
                                </tr>
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
                               
                                <th style="font-size: 12px; vertical-align: middle; color: #FFFFFF; border-right: 1px solid #FFFFFF; border-bottom: 1px solid #036cd9; background-color: #036cd9; font-weight: bold; text-align: left; padding: 7px; border-right: 1px solid #036cd9;">Monther Toung</th>
                                </tr>
                            </thead>
                            <tbody>
                          
                              @foreach($datas['language'] as $language)
                                <tr>
                                  
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$language['language']}}</td>
                                   
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$language['understand']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$language['speak']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$language['read']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$language['write']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$language['mother_t'] == 1 ? 'Yes' : 'No'}}</td>
                                    
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
                                  
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference['name']}}</td>
                                   
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference['designation']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference['address']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference['office_phone']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference['mobile']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference['ref_email']}}</td>
                                    <td style="font-size: 12px; border-right: 1px solid #036cd9; text-align: left; padding: 7px; border-bottom: 1px solid #036cd9;">{{$reference['company']}}</td>
                                </tr>
                              @endforeach
                         
                          </tbody>
                            </table>
@endif
@if($datas['imagepath'] != '' || $datas['resume_path'] != '' || $datas['coverletter_path'] != '' || count($datas['otherfiles']) > 0)
  @if($datas['imagepath'] != '')
    <div style="float: left; width: 25%; padding: 0 10px; margin-bottom: 10px;">
      <a href="{{url('/image/'.$datas['imagepath'])}}" target="_blank"><img src="{{asset('/image/'.$datas['imagepath'])}}" style="width: 100%"></a>
      <div style="width: 100%; line-height: 28px; text-align: center; font-size: 14px; font-weight: 700">PP Photo</div>
    </div>
  @endif
   @if($datas['resume_path'] != '')
    <div style="float: left; width: 25%; padding: 0 10px; margin-bottom: 10px;">
      <a href="{{url('/image/'.$datas['resume_path'])}}" target="_blank"><div style="display: inline-block;background-color: #53b427;font-size: 12px;color: #ffffff;padding: 10px 10px 10px 10px;line-height: 1;margin-right: 5px;font-weight: 400;">Click Here</div></a>
      <div style="width: 100%; line-height: 28px; text-align: center; font-size: 14px; font-weight: 700">Resume</div>
    </div>
  @endif
   @if($datas['coverletter_path'] != '')
    <div style="float: left; width: 25%; padding: 0 10px; margin-bottom: 10px;">
      <a href="{{url('/image/'.$datas['coverletter_path'])}}" target="_blank"><div style="display: inline-block;background-color: #53b427;font-size: 12px;color: #ffffff;padding: 10px 10px 10px 10px;line-height: 1;margin-right: 5px;font-weight: 400;">Click Here</div></a>
      <div style="width: 100%; line-height: 28px; text-align: center; font-size: 14px; font-weight: 700">Cover Letter</div>
    </div>
  @endif
   @if(count($datas['otherfiles']) > 0)
    @foreach($datas['otherfiles'] as $file)
      <div style="float: left; width: 25%; padding: 0 10px; margin-bottom: 10px;">
        <a href="{{url('/image/'.$file['file_path'])}}" target="_blank">
          @if($file['type'] != 0)
          <img src="{{asset('/image/'.$file['file_path'])}}" style="width: 100%">
          @else
          <div style="display: inline-block;background-color: #53b427;font-size: 12px;color: #ffffff;padding: 10px 10px 10px 10px;line-height: 1;margin-right: 5px;font-weight: 400;">Click Here</div>
          @endif
        </a>
        <div style="width: 100%; line-height: 28px; text-align: center; font-size: 14px; font-weight: 700">{{$file['file_title']}}</div>
      </div>
    @endforeach
  @endif

@endif

</div>
</body>

</html>

