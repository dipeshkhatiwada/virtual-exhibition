@extends('employer_master')
@section('content')
  <h3 class="form_heading">Enroll<a href="{{ url('/employer/enroll/addnew') }}" class="btn lightgreen_gradient right">
    <i class="fa fa-fw fa-plus"></i>Add New Enroll</a>
    <div class="clear"></div>
  </h3>
  <div class="form_tabbar">
    <div class="table-responsive-lg">
      <table class="table table_form" id="display-table">
        <thead>
          <th>Company Name</th>
          <th>Booth/Stall</th>
          <th>Booth/Stall</th>
          <th>Price </th>
          <th>Payment Status</th>
          <th>Action</th>
        </thead>
        <tbody>
            @if(count($reserves))
            @foreach ($reserves as $res)
            <tr>
                @if($res->reservations)
                <td> {{ $res->reservations->company_name }} </td>
                @else
                <td></td>
                @endif
                <td> {{ $res->booth_name }}</td>
                <td> {{ $res->booth_type }}</td>
                <td> {{ $res->price }}</td>

                @if($res->reservations)

                <td> @if($res->reservations->payment_status == 1) Completed @else Not Completed @endif</td>
                @else
                <td></td>
                @endif
                <td>
                    <a href="javascript:void(0);" onClick="confirm_delete('/{{$res->id}}')" class="btn whitegradient redclr"><i class="fa fa-fw fa-remove"></i> Delete</a>
                    @if($total_reservation < $res->reservations->category->seat_limit)
                    <a class="btn lightgreen_gradient reserveBooth"
                        reservation-id="{{ $res->reservations->id }}"
                        booth-id="{{ $res->id }}"
                        >
                        <i class='fas fa-cart-plus'></i> &nbsp; Payment With</a>
                    @else
                        <p> Unavailable booth/stall right now. See you soon</p>
                    @endif
                </td>

            </tr>
          @endforeach
          @else
          <tr>
            <td colspan="6"><span class="col-md-12 alert alert-info">Sorry No any events found</span></td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>


<script type="text/javascript">
$(document).ready(function(){
    var base_url = window.location.origin+'/rollingnexus';

    $("a.reserveBooth").click(function(){
        var reservation_id = $(this).attr('reservation-id');
        var booth_id = $(this).attr('booth-id');

        if (booth_id){
            $.ajax({
                type: 'POST',
                url: base_url + '/employer/booth/reserve',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data:{
                    "booth_id": booth_id,
                    "reservation_id" : reservation_id,
                 },
                cache: false,
                success: function(response){
                  // console.log(response);
                  window.location.href = base_url + "/employer/booth/cart";
                }
            });
        } else{
            alert('Payment Option not seleted.');
        }

    });
});
</script>

<script type="text/javascript">
function confirm_delete(ids){
if(confirm('Do You Want To Delete This Data?')){
    var url= "{{ url('/employer/enroll/delete-booth/') }}" + ids;
    location = url;
    }
}
</script>
@endsection
