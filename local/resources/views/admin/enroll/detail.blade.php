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
            <a href="{{ url('/admin/enroll/add') }}" class="btn btn-primary right"><i class="fa fa-fw fa-plus"></i>Add New Exhibition Type</a>
          </div>
            <div class="box">
                <div class="box-body">
                  <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Exhibition Type</th>
                                <th>Exhibition Category</th>
                                <th>seo_url</th>
                                <th>Seat Limit</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count($enroll_categories) > 0)

                                @foreach ($enroll_categories as $key => $cat)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $cat->enroll->title }}</td>
                                    <td>{{ $cat->title }}</td>
                                    <td>{{ $cat->seo_url }}</td>
                                    <td>{{ $cat->seat_limit }}</td>
                                    <td>
                                        <a href="{{route('enroll.editCategory', $cat->id) }}" class="btn btn-success btn-mini" title="Edit Category"><i class="fa fa-fw fa-pencil"></i></a>
                                        <a href="{{route('enroll.destroyCategory', $cat->id) }}" class="btn btn-danger btn-mini deleteRecord" title="Delete Category"><i class="fa fa-fw fa-trash"></i></a>
                                        <a href="{{ route('enroll.addCategory', $cat->id) }}" class="btn btn-info btn-mini" title="Add Category"><i class="fa fa-fw fa-plus"></i></a>

                                    </td>
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
