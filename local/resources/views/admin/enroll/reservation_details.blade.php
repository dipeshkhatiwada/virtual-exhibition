@extends('admin_master')
@section('heading')
Enroll
<small>Reservation Dashboard</small>
@stop
@section('breadcrubm')
<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

<li class="active">Reservation</li>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      {{-- <div class="row">
        <a href="{{ url('/admin/event_category/addnew') }}" class="btn btn-primary right"><i class="fa fa-fw fa-plus"></i>Add New Event Category</a>
      </div> --}}

            <div class="box">
                <div class="box-body">
                  <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Category</th>
                                <th>Company</th>
                                <th>Stall Reserved</th>
                                <th>Stall Paid</th>
                                <th>Remaining to Pay</th>
                                <th>Total Price</td>
                                <th>Payment Status</th>
                                <th>Platform</th>
                                <th>Publish</td>
                                <th class="center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php $temp_category = '';
                                $i = 1;
                            ?>
                                @if( count($reservations)>0 )
                                @foreach ($reservations as $res)
                                <tr>
                                    <td>{{ $i++ }}</td>

                                    <td>{{ $res->category->title }}</td>

                                    <td>{{ $res->company_name  }}</td>
                                    <td>
                                        @foreach ($res['booth_res'] as $key =>$data)
                                            <table>
                                                <tr>
                                                <td>
                                                    {{ $data->booth_name }} | Rs. {{ $data->price }}
                                                </td>
                                                </tr>
                                            </table>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($res['paid_booth'] as $key =>$data)
                                            <table>
                                                <tr>
                                                <td>
                                                    {{ $data->booth_name }} | {{ $data->booth_type}} | Rs. {{ $data->price}}
                                                </td>
                                                </tr>
                                            </table>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if(count($res['unpaid_booth']) > 0)
                                            @foreach ($res['unpaid_booth'] as $key =>$data)
                                                <table>
                                                    <tr>
                                                    <td>
                                                        {{ $data->booth_name }} | {{ $data->booth_type}} | Rs. {{ $data->price}}
                                                    </td>
                                                    </tr>
                                                </table>
                                            @endforeach
                                        @else
                                                -
                                        @endif
                                    </td>
                                    <td>NRs: {{ $res->total_price }}</td>

                                    <td> @if(count($res['paid_booth']) == count($res['booth_res']))  Completed @else Not Completed @endif </td>
                                    <td>
                                        <input type="hidden" id="reservationId" value="{{ $res->id}}">
                                        <select id='selectplatform' width="144" style="height:19px; width:140px; text-align:center;">
                                            <option value="" selected>-Select-</option>
                                            <option id="agora">Agora</option>
                                            <option id="zoom">Zoom</option>
                                        </select>
                                        @if($res->platform)
                                            <p>{{ $res->platform }} choosen</p>
                                        @endif

                                    </td>
                                    <td>
                                        <input type="checkbox" data-toggle="toggle" id="checkBoxId" value="{{ $res->id }}" data-onstyle="success" @if($res->publish_status == 1) checked @endif>
                                    </td>

                                    <td>
                                        <a href="{{route('enroll_reservation.destroy', $res->id) }}" class="btn btn-danger btn-mini deleteRecord" title="Delete Category"><i class="fa fa-fw fa-trash"></i></a>

                                    </td>
                                    <?php $temp_category = $res->category->title ;

                                    ?>

                                </tr>
                                @endforeach
                                @endif

                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
    @if(Session::has('message'))
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{!! session('message') !!}</strong>
    </div>
    @endif
</div>

<script type="text/javascript">
    var base_url = window.location.origin+'/rollingnexus';

    $('select').on('change',function(){
        var platform = $(this).children(":selected").attr("id");

        // var platform =  $( "select option:selected" ).val();
        var reservation_id = $('#reservationId').val();
        console.log(platform);
        $.ajax({
            url:base_url+'/admin/enroll/update-platform',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: {
                'platform':platform,
                'reservationId': reservation_id,
            },
            success:function(response){
                console.log('Success');
            }
        });


})
</script>
<script>
$(document).ready(function(){

    $("input:checkbox").change(function() {
    var res_id = $(this).attr("value");
    $.ajax({
            type:'POST',
            url:'update-publish-status/'+res_id,
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            data: { "reservation_id" : res_id },
            success: function(response){
                console.log(response)
            }
        });
    });


});
</script>
<script type="text/javascript">
$(document).ready(function(){


    $('.deleteRecord').click(function (e){
        e.preventDefault();
        var url = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "Once deleted, You will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                window.location.href = url;
                swal("Deleted!", "Your File has been deleted.", "success");            }
            else {
                swal("Cancelled", "Your File is safe", "error");
              }
        });
    });
});
</script>
@endsection
