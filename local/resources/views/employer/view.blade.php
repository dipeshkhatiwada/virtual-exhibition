@extends('employer_master')

    @section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="employer_profile_view">
                <h3 class="form_heading">{{$datas['employer']->name}}</h3>
                <div class="all10p">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <td class="tdtitle"> Name</td>
                                <td>{{$datas['employer']->name}}</td>
                            </tr>
                            <tr>
                                <td class="tdtitle"> Email</td>
                                <td>{{$datas['employer']->email}}</td>
                            </tr>
                            <tr>
                                <td class="tdtitle"> Phone</td>
                                <td>{{$datas['address']->phone}}</td>
                            </tr>
                            <tr>
                                <td class="tdtitle"> Fax</td>
                                <td>{{$datas['address']->fax}}</td>
                            </tr>
                            <tr>
                                <td class="tdtitle"> Post Box</td>
                                <td>{{$datas['address']->pobox}}</td>
                            </tr>
                            <tr>
                                <td class="tdtitle"> Website</td>
                                <td>{{$datas['address']->website}}</td>
                            </tr> 
                            <tr>
                                <td class="tdtitle"> Address</td>
                                <td>{{$datas['address']->address}}</td>
                            </tr>
                            <tr>
                                <td class="tdtitle"> Secondary Email</td>
                                <td>{{$datas['address']->secondary_email}}</td>
                            </tr>
                            <tr>
                                <td class="tdtitle"> Size</td>
                                <td>{{\App\Size::getTitle($datas['employer']->org_size)}}</td>
                            </tr>
                            <tr>
                                <td class="tdtitle"> Type</td>
                                <td>{{\App\OrganizationType::getOrgTypeTitle($datas['employer']->org_type)}}</td>
                            </tr>
                            <tr>
                                <td class="tdtitle">Member Type</td>
                                <td>{{\App\MemberType::getTitle($datas['employer']->id)}}</td>
                            </tr>
                            <tr>
                                <td class="tdtitle"> Ownership</td>
                                <td>{{\App\Ownership::getTitle($datas['employer']->ownership)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
           
            </div>     
        </div>
    </div>
   @if($datas['employer']->description != '')
   <div class="row mt-3 ">
        <div class="col-md-12">
            <h3 class="form_heading">Description</h3>
            <div class="all10p">
            <div class="white_bg ">
                <div class="col-md-12 all10p">
                    <div class="justify tb15p">
                        <?php echo $datas['employer']->description; ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
   @endif       
   
   @if($datas['employer']->profile != '')
   <div class="row mt-3">
        <div class="col-md-12">
            
                <h3 class="form_heading">Profile</h3>
               
                    <div class="col-md-12 ">
                        <div class="justify pd-5">
                        <?php echo $datas['employer']->profile; ?>
                        </div>
                    </div>
                
           
        </div>
    </div>
   
   @endif   
   
    <div class="row mt-3">
        <div class="col-md-12">
            <h3 class="form_heading">Company Head</h3> 
            <div class="all10p employer_profile_view">
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <td class="tdtitle"> Salutation</td>
                        <td>{{\App\Saluation::getTitle($datas['head']->saluation)}}</td>
                    </tr>
                    <tr>
                        <td class="tdtitle"> Name</td>
                        <td>{{$datas['head']->name}}</td>
                    </tr>
                    <tr>
                        <td class="tdtitle"> Designation</td>
                        <td>{{$datas['head']->designation}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>   
   
        <div class="row mt-3">
        <div class="col-md-12">
          <h3 class="form_heading">Company Contact Person</h3>
          <div class="all10p employer_profile_view">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="tdtitle"> Salutation</td>
                            <td>{{\App\Saluation::getTitle($datas['contact']->saluation)}}</td>
                        </tr>
                        <tr>
                            <td class="tdtitle"> Name</td>
                            <td>{{$datas['contact']->name}}</td>
                        </tr>
                        <tr>
                            <td class="tdtitle"> Designation</td>
                            <td>{{$datas['contact']->designation}}</td>
                        </tr>
                        <tr>
                            <td class="tdtitle"> Phone</td>
                            <td>{{$datas['contact']->phone}}</td>
                        </tr>
                        <tr>
                            <td class="tdtitle"> E-mail</td>
                            <td>{{$datas['contact']->email}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
                </div>
                </div>
                
                
                
  

@endsection