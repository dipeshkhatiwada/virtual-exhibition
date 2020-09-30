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
                    <tr>
                        <th>S.N.</th>
                        <th>Category</th>
                        <th>Company name</th>
                        <th>Website</th>
                        <th>Intro Video Link </th>
                        <th>Stall Reserved</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                        $i = 1;
                    ?>
                    @if( count($reservations)>0 )
                    @foreach ($reservations as $res)
                        <tr>
                            <td>{{ $i++ }}</td>

                            <td>{{ $res->category->title }}</td>

                            <td>{{ $res->company_name  }}</td>
                            <td>{{ $res->company_website }} </td>
                            <td>{{ $res->intro_video }}</td>
                            <td>
                                @foreach ($res['boothreserves'] as $key =>$booth)
                                    <table>
                                        <tr>
                                        <td>
                                            {{ $booth->booth_name }} | {{ $booth->booth_type }} | Rs. {{ $booth->price }}
                                        </td>
                                        <td>
                                            <a href="{{ url('/employer/enroll/delete-booth/'.$booth->id) }}" class="btn whitegradient redclr deleteRecord" title="Delete Booth"><i class="fa fa-trash"></i></a>

                                            {{-- <a href="{{ url('/employer/enroll/delete-booth/'.$booth->id) }}" class="btn whitegradient redclr"><i class="fa fa-trash"></i> Edit</a></div> --}}
                                        </td>
                                        </tr>
                                    </table>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ url('/employer/enroll/edit/'.$res->id) }}" class="btn btn-success btn-mini" title="Edit Booth"><i class="fa fa-fw fa-pencil"></i></a>
                                <a href="{{ url('/employer/enroll/all-delete/'.$res->id) }}" class="btn btn-danger btn-mini deleteRecord" title="Delete Category"><i class="fa fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
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
