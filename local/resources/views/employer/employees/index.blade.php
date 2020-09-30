@extends('employer_master')
@section('content')
<div class="careerfy-typo-wrap">
                                <div class="careerfy-employer-dasboard">
                                    <div class="careerfy-employer-box-section">
                                        <!-- Profile Title -->
                                        <div class="careerfy-profile-title">
                                            <h2>Applicants</h2>
                                            
                                        </div>
                                        @if(count($employees) > 0)
                                        <!-- Manage Jobs -->
                                        <div class="careerfy-managejobs-list-wrap">
                                            <div class="careerfy-managejobs-list">
                                                <!-- Manage Jobs Header -->
                                                <div class="careerfy-table-layer careerfy-managejobs-thead">
                                                    <div class="careerfy-table-row">
                                                        <div class="careerfy-table-cell">Employee Name</div>
                                                        <div class="careerfy-table-cell">Email</div>
                                                        <div class="careerfy-table-cell">Gender</div>
                                                        <div class="careerfy-table-cell">Date of Birth</div>
                                                        <div class="careerfy-table-cell"></div>
                                                    </div>
                                                </div>
                                                @foreach($employees as $employee)
                                                <!-- Manage Jobs Body -->
                                                <div class="careerfy-table-layer careerfy-managejobs-tbody">
                                                    <div class="careerfy-table-row">
                                                        <div class="careerfy-table-cell">
                                                            <h6><a href="{{url('employer/emplyee/view'.$emplyee->id)}}">{{\App\Employees::getFullname($employee->firstname, $employee->middlename, $employee->lastname)}}</a></h6>
                                                            <ul>
                                                                <?php $jobs = \App\JobApply::getApplyJobs($employee->id); ?>
                                                                @if(count($jobs) > 0)
                                                                @foreach($jobs as $job)
                                                                <li><i class="fa fa-bookmark"></i><span>{{$job}}</span></li>
                                                                @endforeach
                                                                @endif
                                                                
                                                                
                                                            </ul>
                                                        </div>
                                                        <div class="careerfy-table-cell">{{$employee->email}}</div>
                                                        <div class="careerfy-table-cell">{{$employee->gender}}</div>
                                                       

                                                        <div class="careerfy-table-cell">{{$employee->dob}}</div>
                                                        <div class="careerfy-table-cell">
                                                            <div class="careerfy-managejobs-links">
                                                                <a target="_blank" href="{{url('employer/emplyee/view'.$emplyee->id)}}" class="view fa fa-eye"></a>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                
                                                
                                                <!-- Manage Jobs Body -->
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- Pagination -->
                                        <div class="careerfy-pagination-blog">
                                             <?php echo $employees->render();?>
                                        </div>
                                        @else
                                        <div style="clear: both;"></div>
                                        <div class="alert alert-info text-center">
                                                <span class="icon-circle-warning mr-2"></span>
                                                Sorry there are not any Applicant at the moment.
                                               
                                                </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            
@endsection