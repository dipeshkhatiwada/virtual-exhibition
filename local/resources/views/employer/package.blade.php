@extends('employer_master')
@section('content')
<div class="row">
<div class="col-md-12 careerfy-typo-wrap">
    <div class="careerfy-employer-dasboard">
        <div class="">
            <!-- Profile Title -->
            <h3 class="form_heading">Your Orders <a href="{{url('/employer/buy_package')}}" class="btn lightgreen_gradient right">
    <i class="fa fa-fw fa-plus"></i>By Package</a></h3>

                <div class="careerfy-employer-box-section">
            @if(count($datas['packages']) > 0)
            <!-- Manage Jobs -->
            <div class="careerfy-managejobs-list-wrap">
                <div class="careerfy-managejobs-list">
                    <!-- Manage Jobs Header -->
                    <div class="careerfy-table-layer careerfy-managejobs-thead">
                        <div class="careerfy-table-row">
                            <div class="careerfy-table-cell">Package For</div>
                            <div class="careerfy-table-cell">Type</div>
                            <div class="careerfy-table-cell">Duration</div>
                            <div class="careerfy-table-cell">Numbers</div>
                            <div class="careerfy-table-cell">Remaining</div>
                            <div class="careerfy-table-cell">Purchase Date</div>
                            <div class="careerfy-table-cell">Expiry Date</div>
                        </div>
                    </div>
                    @foreach($datas['packages'] as $package)
                    @php($type = '')
                    @if($package->type == 'Job')
                    @php($type = \App\JobType::getTitle($package->job_type))
                    @elseif($package->type == 'Tender')
                    @php($type = \App\TenderFunctionType::getTitle($package->job_type))
                    @endif
                    <div class="careerfy-table-layer careerfy-managejobs-tbody">
                        <div class="careerfy-table-row">
                            <div class="careerfy-table-cell">{{$package->type}}</div>
                            
                            
                            <div class="careerfy-table-cell">{{$type}}</div>
                            <div class="careerfy-table-cell">{{$package->duration}} Day(s)</div>
                            <div class="careerfy-table-cell">{{$package->job_number}}</div>
                            <div class="careerfy-table-cell">{{$package->remaining}}</div>
                            <div class="careerfy-table-cell">{{$package->purchase_date}}</div>
                            <div class="careerfy-table-cell">{{$package->expiry_date}}</div>
                        </div>
                    </div>
                    <!-- Manage Jobs Body -->
                    @endforeach
                </div>
            </div>
            <!-- Pagination -->
            <div class="careerfy-pagination-blog">
                 <?php echo $datas['packages']->render();?>
            </div>
            @else
            <div style="clear: both;"></div>
            <div class="alert alert-info text-center">
                    <span class="icon-circle-warning mr-2"></span>
                    You don't have any Package at the moment. <a href="{{url('/employer/buy_package')}}" class="btn lightgreen_gradient">Buy Package</a>
                   
                    </div>
            @endif
          </div>

        </div>
    </div>
</div>
</div>

@endsection



