@extends('employer_master')

@section('content')
<div class="all10p">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-12">
        <!--New post section ended here-->
        <div id="all-post-detail">
            <div class="row">
                <div class="col-md-12 careerfy-typo-wrap">
                    <div class="careerfy-employer-dasboard">
                        <div class="">
                            <!-- Profile Title -->
                            <h3 class="form_heading">Your Orders</h3>

                                <div class="careerfy-employer-box-section">
                            @if(count($data['invoice']) > 0)
                            <!-- Manage Jobs -->
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['invoice'] as $job)
                                    <tr>
                                        <td>{{ $job->amount }}</td>
                                        <td>{{ $job['invoice_status'] }}</td>
                                        <td>{{ $job->created_at }}</td>
                                        <td>
                                            <a href="{{url('employer/enroll-invoice/view/'.$job->id)}}" class="btn whitegradient blueclr"><i class="fa fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                            <!-- Pagination -->

                            @else
                            <div style="clear: both;"></div>
                            <div class="alert alert-info text-center">
                                    <span class="icon-circle-warning mr-2"></span>
                                    You don't have any Orders at the moment.
                                    </div>
                            @endif


                        </div>
                    </div>
                </div>
        <!--Posted feed ended here-->
        </div>
        <!--ended post with image-->
      </div>

      </div>
    </div>
  </div>
@endsection
