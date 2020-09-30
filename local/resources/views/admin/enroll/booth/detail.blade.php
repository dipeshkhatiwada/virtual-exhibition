@extends('admin_master')
@section('heading')
Virtual Exhibition
<small>Exhibition Dashboard</small>
@stop
@section('breadcrubm')
<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <a href="{{ url('/admin/enroll/booth/create') }}" class="btn btn-primary right"><i class="fa fa-fw fa-plus"></i>Add New Booth</a>
          </div>
            <div class="box">
                <div class="box-body">
                  <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Booth/Stall Name</th>
                                <th>Ticket Type</th>
                                <th>Price</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        @if(count($booth_types) > 0)
                        <?php $title = '';?>
                        @foreach ($booth_types as $key=>$type )
                            <tr>

                                @if($title == $type->booth->booth_name)
                                <td></td>
                                @else
                                <td>{{$type->booth->booth_name}} </td>
                                @endif
                                <td>{{ $type->ticket_name }}</td>
                                <td>{{ $type->price }}</td>
                                <td class="center">
                                    <a href="{{route('enroll.editBoothAttr', $type->id)}}" class="btn btn-success btn-mini" title="Edit Booth"><i class="fa fa-fw fa-pencil"></i></a>
                                    <a href="{{route('enroll.deleteBoothAttr', $type->id)}}" class="btn btn-danger btn-mini deleteRecord" title="Delete Type"><i class="fa fa-fw fa-trash"></i></a>
                                    <a href="{{ route('booth.add', $type->booth->id)}}" class="btn btn-info btn-mini" title="Add Ticket Type"><i class="fa fa-fw fa-plus"></i></a>

                                </td>
                                <?php $title = $type->booth->booth_name; ?>
                            </tr>
                        @endforeach
                        @endif
                        <tbody>

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
